<?php
global $conn;
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" ) {
  $body = $_POST["body"];
  $userid = $_POST["userid"];

  // Insert data into the database
  $sql = "INSERT INTO `posts`(`post_userid`,`document`) VALUES ('$userid ','$body ');";

  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
