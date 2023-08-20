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

 $sql = "SELECT * FROM motherboard";
 $result = $conn -> query ($sql);

 if(isset($_POST['update_update_btn'])){
  $name = $_POST['update_name'];
  $price = $_POST['update_Price'];
  $hierarchy=$_POST['hierarchy'];
  $update_id = $_POST['update_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `motherboard` SET motherboard_name='$name' ,motherboard_price='$price',motherboard_hierarchy='$hierarchy' WHERE motherboard_id = '$update_id'");
  if($update_quantity_query){
     header('location:all_product.php');
  };
};

 if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `motherboard` WHERE motherboard_id = '$remove_id'");
  header('location:all_product.php');
  ob_end_flush();
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pending_orders.css">

</head>
<body>

<div class="container pendingbody">
  <h5>Motherboard</h5>
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
        <input type="hidden" name="update_id"  value="<?php echo  $row['motherboard_id']; ?>" >
        <td><input type="text" name="update_name"  value="<?php echo $row['motherboard_name']; ?>" ></td>
        <td> <input type="number" name="update_Price" value="<?php echo $row['motherboard_price']; ?>" ></td>
         <td> <input type="number" name="hierarchy" value="<?php echo $row['motherboard_hierarchy']; ?>" ></td>
        <td> <input type="submit" value="update" name="update_update_btn">
      </form></td>
      <td><a href="all_product.php?remove=<?php echo $row['motherboard_id']; ?>">remove</a></td>
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