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
    $name=$_POST['software_name'];
    $image=$_FILES["software_image"]["name"];
    $cpu=$_POST['software_cpu'];
    $gpu=$_POST['software_gpu'];
    $ram=$_POST['software_ram'];
    $motherboard=$_POST['software_motherboard'];



    $insertSql = "INSERT INTO software(software_name,software_image,software_cpu,software_gpu,software_ram,software_motherboard) VALUES ('$name',$image,'$cpu','$gpu','$ram','$motherboard' )";

    if ($conn -> query ($insertSql))
    {
        $result="<h2>Data Successfully inserted</h2>";
        $tempname = $_FILES["software_image"]["tmp_name"];
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
            <label for="exampleInputName" class="form-label">Software Name</label>
            <input type="text" name="software_name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="software_image" class="form-label">Image</label>
            <input type="file" name="software_image" />
        </div>

        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Software CPU</label>
            <input type="text" name="software_cpu" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Software GPU</label>
            <input type="text" name="software_gpu" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Software RAM</label>
            <input type="text" name="software_ram" class="form-control" id="exampleInputDescription">
        </div>
        <div class="mb-3">
            <label for="exampleInputDescription" class="form-label">Software Motherboard</label>
            <input type="text" name="software_motherboard" class="form-control" id="exampleInputDescription">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>