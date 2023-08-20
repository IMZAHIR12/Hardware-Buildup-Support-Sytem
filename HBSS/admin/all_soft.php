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

$sql = "SELECT * FROM software";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
    $name = $_POST['software_name'];
    $image = $_POST['software_image'];
    $cpu=$_POST['software_cpu'];
    $gpu=$_POST['software_gpu'];
    $ram=$_POST['software_ram'];
    $motherboard=$_POST['soft_motherboard'];

    $update_id = $_POST['update_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `software` SET software_name='$name' ,software_image='$image',software_cpu='$cpu',software_gpu='$gpu',software_ram='$ram',software_motherboard='$motherboard'  WHERE software_id = '$update_id'");
    if($update_quantity_query){
        header('location:all_soft.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `software` WHERE software_id = '$remove_id'");
    header('location: all_soft.php');
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
    <h5>Softwares</h5>
    <div id="cpunav">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">CPU</th>
                <th scope="col">GPU</th>
                <th scope="col">RAM</th>
                <th scope="col">Motherboard</th>
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
                    <input type="hidden" name="update_id"  value="<?php echo  $row['software_id']; ?>" >
                    <td><input type="text" name="software_name"  value="<?php echo $row['software_name']; ?>" ></td>
                    <td><img src="product_img/<?php echo $row['software_image']; ?>" style="width:50px;"></td>
                    <td> <input type="text" name="software_cpu" value="<?php echo $row['software_cpu']; ?>" ></td>
                    <td> <input type="text" name="software_gpu" value="<?php echo $row['software_gpu']; ?>" ></td>
                    <td> <input type="text" name="software_ram" value="<?php echo $row['software_ram']; ?>" ></td>
                    <td> <input type="text" name="software_motherboard" value="<?php echo $row['software_motherboard']; ?>" ></td>
                    <td> <input type="submit" value="update" name="update_update_btn">
                </form></td>
                <td><a href="all_cpu.php?remove=<?php echo $row['software_id']; ?>">remove</a></td>
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
