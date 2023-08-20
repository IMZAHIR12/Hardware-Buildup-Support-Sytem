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
    $name=$_POST['ram_name'];
    $price=$_POST['ram_price'];
    $description=$_POST['ram_hierarchy'];



    $insertSql = "INSERT INTO ram(ram_name,ram_price, ram_hierarchy) VALUES ('$name',$price, '$description' )";

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
    <h4>Add GPU</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">RAM Name</label>
            <input type="text" name="ram_name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="exampleInputPrice" class="form-label">Price</label>
            <input type="Number" name="ram_price" class="form-control" id="exampleInputPrice">
        </div>

        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">RAM Hierarchy</label>
            <input type="text" name="ram_hierarchy" class="form-control" id="exampleInputDescription">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>