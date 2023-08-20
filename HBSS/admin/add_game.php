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
    $name=$_POST['games_name'];
    $image=$_FILES["games_image"]["name"];
    $cpu=$_POST['games_cpu'];
    $gpu=$_POST['games_gpu'];
    $ram=$_POST['games_ram'];
    $motherboard=$_POST['games_motherboard'];



    $insertSql = "INSERT INTO software(games_name,games_image,games_cpu,games_gpu,games_ram,games_motherboard) VALUES ('$name',$image,'$cpu','$gpu','$ram','$motherboard' )";

    if ($conn -> query ($insertSql))
    {
        $result="<h2>Data Successfully inserted</h2>";
        $tempname = $_FILES["games_image"]["tmp_name"];
        $folder = "product_img/".$image;

        move_uploaded_file($tempname, $folder);

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
            <label for="exampleInputName" class="form-label">Game Name</label>
            <input type="text" name="games_name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="software_image" class="form-label">Image</label>
            <input type="file" name="games_image" />
        </div>

        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Game CPU</label>
            <input type="text" name="games_cpu" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Game GPU</label>
            <input type="text" name="games_gpu" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Game RAM</label>
            <input type="text" name="games_ram" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Game Motherboard</label>
            <input type="text" name="games_motherboard" class="form-control" id="exampleInputDescription">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>