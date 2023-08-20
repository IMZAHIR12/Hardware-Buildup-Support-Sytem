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

 $sql = "SELECT * FROM users";
 $result = $conn -> query ($sql);
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
  <h5>All Users</h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
        <th scope="col">Birth</th>
        <th scope="col">Gender</th>
        <th scope="col">Jobtitle</th>
        <th scope="col">Nationality</th>
        <th scope="col">Users_name</th>
    </tr>
  </thead>
  <tbody>
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>
      <td><?php echo $row["users_id"] ?></td>
      <td><?php echo $row["users_name"] ?></td>
      <td><?php echo $row["users_email"] ?></td>
      <td><?php echo $row["users_birth"] ?></td>
        <td><?php echo $row["users_gender"] ?></td>
        <td><?php echo $row["users_jobtitle"] ?></td>
        <td><?php echo $row["users_nationality"] ?></td>
        <td><?php echo $row["users_username"] ?></td>

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