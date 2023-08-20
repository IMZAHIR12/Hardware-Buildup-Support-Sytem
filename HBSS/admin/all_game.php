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

$sql = "SELECT * FROM games";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
    $name = $_POST['games_name'];
    $image = $_POST['games_image'];
    $cpu=$_POST['games_cpu'];
    $gpu=$_POST['games_gpu'];
    $ram=$_POST['games_ram'];
    $motherboard=$_POST['games_motherboard'];

    $update_id = $_POST['update_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `games` SET games_name='$name' ,games_image='$image',games_cpu='$cpu',games_gpu='$gpu',games_ram='$ram',games_motherboard='$motherboard'  WHERE games_id = '$update_id'");
    if($update_quantity_query){
        header('location:all_game.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `games` WHERE games_id = '$remove_id'");
    header('location: all_game.php');
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
    <link rel="stylesheet" href="css/pending_orders.css">

</head>
<body>

<div id="container2">
    <h5>Games</h5>
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
                    <input type="hidden" name="update_id"  value="<?php echo  $row['games_id']; ?>" >
                    <td><input type="text" name="games_name"  value="<?php echo $row['games_name']; ?>" ></td>
                    <td><img src="product_img/<?php echo $row['games_image']; ?>" style="width:50px;"></td>
                    <td> <input type="text" name="games_cpu" value="<?php echo $row['games_cpu']; ?>" ></td>
                    <td> <input type="text" name="games_gpu" value="<?php echo $row['games_gpu']; ?>" ></td>
                    <td> <input type="text" name="games_ram" value="<?php echo $row['games_ram']; ?>" ></td>
                    <td> <input type="text" name="games_motherboard" value="<?php echo $row['games_motherboard']; ?>" ></td>
                    <td> <input type="submit" value="update" name="update_update_btn">
                </form></td>
                <td><a href="all_cpu.php?remove=<?php echo $row['games_id']; ?>">remove</a></td>
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
