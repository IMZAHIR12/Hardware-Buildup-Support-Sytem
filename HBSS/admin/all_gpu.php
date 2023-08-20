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

$sql = "SELECT * FROM gpu";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
    $id = $_POST['gpu_id'];
    $name = $_POST['gpu_name'];
    $price = $_POST['gpu_price'];
    $hierarchy=$_POST['gpu_hierarchy'];

    $update_quantity_query = mysqli_query($conn, "UPDATE `gpu` SET gpu_name='$name' ,gpu_price='$price',gpu_hierarchy='$hierarchy'  WHERE gpu_id = '$id'");
    if($update_quantity_query){
        header('location:all_gpu.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `gpu` WHERE gpu_id = '$remove_id'");
    header('location:all_gpu.php');
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

</head>
<body>

<div class="container pendingbody">
    <h5>GPU</h5>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Hierarchy</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="gpu_id"  value="<?php echo  $row['gpu_id']; ?>" >
                        <td><input type="text" name="gpu_name"  value="<?php echo $row['gpu_name']; ?>" ></td>
                        <td> <input type="number" name="gpu_price" value="<?php echo $row['gpu_price']; ?>" ></td>
                        <td> <input type="number" name="gpu_hierarchy" value="<?php echo $row['gpu_hierarchy']; ?>" ></td>
                        <td> <input type="submit" value="update" name="update_update_btn">
                    </form></td>
                    <td><a href="all_gpu.php?remove=<?php echo $row['gpu_id']; ?>">remove</a></td>
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