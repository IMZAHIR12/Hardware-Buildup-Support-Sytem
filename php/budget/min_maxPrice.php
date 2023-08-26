<?php
global $conn;
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputValue = $_POST["inputValue"];

    $sql = "SELECT * FROM `software` WHERE `software_id` = $inputValue";
    $result = $conn->query($sql);

    $sql2 = "SELECT * FROM `games` WHERE `games_id` = $inputValue";
    $result2 = $conn->query($sql2);

    $data = [];

    $components = [];

    $cpu_components = [];
    $gpu_components = [];
    $ram_components = [];
    $motherboard_components = [];
    $cpu = [];
    $gpu = [];
    $ram = [];
    $motherboard = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cpu_components = explode(',', $row['software_cpu']);
            $gpu_components = explode(',', $row['software_gpu']);
            $ram_components = explode(',', $row['software_ram']);
            $motherboard_components = explode(',', $row['software_motherboard']);
        }
    } else if ($result2->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cpu_components = explode(',', $row['games_cpu']);
            $gpu_components = explode(',', $row['games_gpu']);
            $ram_components = explode(',', $row['games_ram']);
            $motherboard_components = explode(',', $row['games_motherboard']);
        }
    }

    function getValue(&$parts, $table, $id, $conn, &$part) {
        foreach ($parts as $component) {
            $sql = "SELECT * FROM $table WHERE $id = $component";
            $result = $conn->query($sql);
    
            $data = [];
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[$row[$table.'_name']] = ["price" => (float)$row[$table.'_price'], "performance" => (float)$row[$table.'_hierarchy']];
                }
            }
            array_push($part, $data);
        }
    }

    getValue($cpu_components, 'cpu', 'cpu_id', $conn, $cpu);
    getValue($gpu_components, 'gpu', 'gpu_id', $conn, $gpu);
    getValue($ram_components, 'ram', 'ram_id', $conn, $ram);
    getValue($motherboard_components, 'motherboard', 'motherboard_id', $conn, $motherboard);

    $components['CPU'] = $cpu;
    $components['GPU'] = $gpu;
    $components['RAM'] = $ram;
    $components['MotherBoard'] = $motherboard;

    function generateCombinations($components, $currentCombination, $startIndex, &$combinations)
    {
        if ($startIndex >= count($components)) {
            $combinations[] = $currentCombination;
            return;
        }

        $componentType = array_keys($components)[$startIndex];
        foreach ($components[$componentType] as $componentName) {
            $newCombination = $currentCombination;
            $newCombination[$componentType] = $componentName;
            generateCombinations($components, $newCombination, $startIndex + 1, $combinations);
        }
    }


    $allCombinations = [];
    generateCombinations($components, [], 0, $allCombinations);

    $max = 0;
    $min = 999999999999;

    foreach ($allCombinations as $combination) {
        $totalCost = 0;
        $totalPerformance = 0;

        foreach ($combination as $componentType => $selectedComponent) {
            $selectedComponent = array_key_first($selectedComponent);
            $price = 0;
            $performance = 0;
            for ($i = 0; $i < count($components[$componentType]); $i++) {
                if ($components[$componentType][$i][$selectedComponent]["price"]) {
                    $price = $components[$componentType][$i][$selectedComponent]["price"];
                }
            }
            $totalCost += $price;
            $totalPerformance += $performance;
        }

        if ($totalCost >= $max) {
            $max = $totalCost;
        } 
        if ($totalCost <= $min) {
            $min = $totalCost;
        }
    }

    echo json_encode([$max, $min]);

    $conn->close();
}
