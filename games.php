<?php

global $conn;
require_once './php/connection.php';


$categories = array();
$categoryQuery = "SELECT id, cat_name FROM game_categories";
$categoryResult = $conn->query($categoryQuery);
if ($categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[$row['id']] = $row['cat_name'];
    }
}

// Fetch products with their categories
$products = array();
$productQuery = "SELECT games_name
                 FROM games 
                 INNER JOIN game_categories  ON games.games_id = game_categories.id";
$productResult = $conn->query($productQuery);
if ($productResult->num_rows > 0) {
    while ($row = $productResult->fetch_assoc()) {
        $products[] = $row;
    }
}




$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/94bda38f84.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="main.css">
<style>
    #cat{
        color: #0b0910;
        font-family: "Poppins" , sans-serif;
        font-style: italic;

    }
    .cat{
        column-gap: 5px;
    }

</style>

  <title>Hardware Buildup Support System</title>
</head>

<body>
<header>
  <nav>
    <div class="title">
      <h1>Hardware Manager</h1>
      <hr></hr>
    </div>
    <div class="search-box">
      <input type="search" class="search" id="search" onchange="getGames()">
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <div class="menu">
      <p>Home</p>
      <p><a href="./index.html">Software</a></p>
      <div class="active">
        <h2>Games</h2>
        <i class="fa-solid fa-circle"></i>
      </div>
      <p>Q/A</p>
    </div>
    <a class="login" id="login" href="Login_SignUp.html">Login</a>
  </nav>
  <div class="hero">
    <h2>Which <span>games</span> do you want to run?</h2>
    <div class="search-box-hero">
      <input type="search" class="search">
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
  </div>
  <h2 class="sw">Games:</h2>
  <div class="softwares">
    <div class="sidenav" id="cat_name">

        <?php foreach ($categories as $categoryID => $categoryName) { ?>
        <a class="cat" style="text-decoration: none" id="" href="game_cat.php?id=<?php echo $row["category"]; ?>"><h3 id="cat"><?php echo $categoryName;?></h3></a>
        <?php } ?>


    </div>


    <div class="gamename" id="gamename">
      <a class="game" href="php/game_cat.php">

        <img src="./images/gtav.png"></img>
        <p>GTA V</p>
      </a>


    </div>




  </div>
</header>

<script>
function getGames() {
const inputvalue = document.getElementById('search').value;
const xhr = new XMLHttpRequest();

// Configure the AJAX request (POST method and PHP file to handle the request)
xhr.open('POST', './php/game_cat.php', true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

// Define what to do when the AJAX request completes
xhr.onreadystatechange = function () {
if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
// Display the result returned from the PHP script
const result1 = JSON.parse(xhr.responseText);
console.log(result1);
console.log(result1.length);
let html = "";
for(let i=0; i < result1.length; i++) {
html+=
'<a class="soft" href="#">\n' +
    '<img src="./images/'+ result1[i]['games_image']+ '"></img>\n' +
    '<p>'+ result1[i]['games_name'] + '</p>';
    }
    if (result1.length <= 0) {
    html += "<p>Games cannot be found</P>";
    }
    document.getElementById('gamename').innerHTML = html;
    }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
    }
</script>




<script src="./javascript/script2.js"></script>
</body>
</html>

