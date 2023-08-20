<?php

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
$result=null;
if (isset($_POST['submit']))
{
    $name=$_POST['cpu_name'];
    $price=$_POST['cpu_price'];
    $description=$_POST['cpu_hierarchy'];
    $brand=$_POST['cpu_brand'];
    $hz=$_POST['cpu_hz'];
    $gen=$_POST['cpu_gen'];



    $insertSql = "INSERT INTO cpu(cpu_name,cpu_price,cpu_hierarchy,cpu_brand,cpu_hz,cpu_gen) VALUES ('$name',$price,'$description','$brand','$hz','$gen' )";

    if ($conn -> query ($insertSql))
    {
        $result="<h2>Data Successfully inserted</h2>";

    }
    else
    {
        die($conn -> error);
    }

}


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
<div class="container">
    <?php echo $result;?>
    <h4>Add CPU</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">CPU Name</label>
            <input type="text" name="cpu_name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="exampleInputPrice" class="form-label">Price</label>
            <input type="Number" name="cpu_price" class="form-control" id="exampleInputPrice">
        </div>

        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">CPU Hierarchy</label>
            <input type="text" name="cpu_hierarchy" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">CPU Brand</label>
            <input type="text" name="cpu_brand" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">CPU Hz</label>
            <input type="text" name="cpu_hz" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">CPU Genration</label>
            <input type="text" name="cpu_gen" class="form-control" id="exampleInputDescription">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>