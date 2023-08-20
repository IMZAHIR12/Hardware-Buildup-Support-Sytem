<?php
global $conn;
require_once 'connection.php';

// Handling login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass_word = $_POST["password"];

    $sql = 'SELECT * FROM users WHERE users_email = "'. $email .'" AND user_password = "'. $pass_word .'"';
    $result = $conn->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            echo json_encode($data);
        }
    } else {
        // Invalid login
        echo json_encode("Login failed!");
    }

}

$conn->close();
?>
