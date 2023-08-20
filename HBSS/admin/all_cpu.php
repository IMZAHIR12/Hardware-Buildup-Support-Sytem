<?php
ob_start();
global $conn;
SESSION_START();

if(isset($_SESSION['auth']))
{
    if($_SESSION['auth']!=1)
    {
        header("location:login.php");
    }
}
else
{
    header("location:login.php");
}
include'header.php';
include'lib/connection.php';

$sql = "SELECT * FROM cpu";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
    $name = $_POST['cpu_name'];
    $price = $_POST['cpu_price'];
    $hierarchy=$_POST['cpu_hierarchy'];
    $brand=$_POST['cpu_brand'];
    $hz=$_POST['cpu_hz'];
    $gen=$_POST['cpu_gen'];

    $update_id = $_POST['update_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cpu` SET cpu_name='$name' ,cpu_price='$price',cpu_hierarchy='$hierarchy',cpu_brand='$brand',cpu_hz='$hz',cpu_gen='$gen'  WHERE cpu_id = '$update_id'");
    if($update_quantity_query){
        header('location:all_cpu.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cpu` WHERE cpu_id = '$remove_id'");
    header('location: all_cpu.php');
};
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main_2.css">

</head>
<body>

<div id="container2">
    <h5>CPU</h5>
    <div id="cpunav">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Hierarchy</th>
                <th scope="col">Brand</th>
                <th scope="col">Hz</th>
                <th scope="col">Generation</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
    </div>

        <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="update_id"  value="<?php echo  $row['cpu_id']; ?>" >
                        <td><input type="text" name="cpu_name"  value="<?php echo $row['cpu_name']; ?>" ></td>
                        <td> <input type="number" name="cpu_price" value="<?php echo $row['cpu_price']; ?>" ></td>
                        <td> <input type="number" name="cpu_hierarchy" value="<?php echo $row['cpu_hierarchy']; ?>" ></td>
                        <td> <input type="text" name="cpu_brand" value="<?php echo $row['cpu_brand']; ?>" ></td>
                        <td> <input type="text" name="cpu_hz" value="<?php echo $row['cpu_hz']; ?>" ></td>
                        <td> <input type="text" name="cpu_gen" value="<?php echo $row['cpu_gen']; ?>" ></td>
                        <td> <input type="submit" value="update" name="update_update_btn">
                    </form></td>
                    <td><a href="all_cpu.php?remove=<?php echo $row['cpu_id']; ?>">remove</a></td>
                </tr>
                <?php
            }
        }
        else
            echo "0 results";
        ?>
        </tbody>
    </table>



</div>

</body>
</html>