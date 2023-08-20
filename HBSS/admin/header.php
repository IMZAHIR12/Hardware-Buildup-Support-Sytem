<?php
global $conn;
include'lib/connection.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-btn {width:150px;}
    </style>
</head>

<link rel="stylesheet" href="./css/main_2.css">
<link rel="stylesheet" href="./css/styles_2.css">
<link rel="stylesheet" href="./css/Login_2.css">

	<section class="header" id="header">
		<h1>Hardware Manager</h1>
	</section>
    <a class="login" id="login" href="logout.php">Log-Out</a>


<body>
   <h1 class="admin">Welcome To The Admin Panel</h1>


    <div class="softwares">
        <div class="sidenav">
            <a class="catname" href="all_cpu.php">
                <i class="fa-solid fa-circle"></i>
                <p>CPU</p>
            </a>
            <a class="catname" href="all_gpu.php">
                <i class="fa-solid fa-circle"></i>
                <p>GPU</p>
            </a>
            <a class="catname" href="all_ram.php">
                <i class="fa-solid fa-circle"></i>
                <p>RAM</p>
            </a>
            <a class="catname" href="all_product.php">
                <i class="fa-solid fa-circle"></i>
                <p>Motherboard</p>
            </a>
            <a class="catname" href="all_soft.php">
                <i class="fa-solid fa-circle"></i>
                <p>Software</p>
            </a>
            <a class="catname" href="all_game.php">
                <i class="fa-solid fa-circle"></i>
                <p>Games</p>
            </a>
            <a class="catname" href="add_cpu.php">
                <i class="fa-solid fa-circle"></i>
                <p>ADD CPU</p>
            </a>
            <a class="catname" href="add_product2.php">
                <i class="fa-solid fa-circle"></i>
                <p>ADD GPU</p>
            </a>
            <a class="catname" href="add_ram.php">
                <i class="fa-solid fa-circle"></i>
                <p>ADD RAM</p>
            </a>

            <a class="catname" href="add_product.php">
                <i class="fa-solid fa-circle"></i>
                <p>ADD Motherboard</p>
            </a>

            <a class="catname" href="add_soft.php">
                <i class="fa-solid fa-circle"></i>
                <p>Add Software</p>
            </a>

            <a class="catname" href="add_game.php">
                <i class="fa-solid fa-circle"></i>
                <p>Add Games</p>
            </a>

            <a class="catname" href="users.php">
                <i class="fa-solid fa-circle"></i>
                <p>Users</p>
            </a>

            <a class="catname" href="report.php">
                <i class="fa-solid fa-circle"></i>
                <p>Report</p>
            </a>
        </div>
        </div>








    </div>








<!--    <div class="sidenav" id="sidenav">-->
<!--		<ul class="navbar-nav">-->
<!--		   <li class="nav-item">-->
<!--				<a class="nav-link d" href="Home.php">Dashboard</a>-->
<!--			</li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link vp" href="all_cpu.php">CPU</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link vp" href="add_cpu.php">Add CPU</a>-->
<!--            </li>-->
<!---->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link vp" href="all_product.php">Motherboard</a>-->
<!--            </li>-->
<!--			<li class="nav-item">-->
<!--				<a class="nav-link ap" href="add_product.php">Add motherboard</a>-->
<!--			</li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link ao" href="all_gpu.php">GPU</a>-->
<!--            </li>-->
<!---->
<!--			<li class="nav-item">-->
<!--				<a class="nav-link ao" href="add_product2.php">Add GPU</a>-->
<!--			</li>-->
<!---->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link po" href="all_ram.php">RAM</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link po" href="add_ram.php">Add RAM</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link u" href="users.php">Users</a>-->
<!--            </li>-->
<!--			<li class="nav-item">-->
<!--                <a class="nav-link u" href="report.php">Report</a>-->
<!--            </li>-->
<!--		</ul>-->
<!--	</div>-->

<!--js link-->
<script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
      integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
      crossorigin="anonymous"
    ></script>
<script src="js/script.js"></script>
<script src="https://kit.fontawesome.com/3b83a3096d.js" crossorigin="anonymous"></script>

</body>
</html>