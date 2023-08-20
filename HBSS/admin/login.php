<?php

global $conn;
SESSION_START();

if(isset($_SESSION['auth']))
{
    if($_SESSION['auth']==1)
    {
        header("location:home.php");
    }
}


include "lib/connection.php";
    if (isset($_POST['submit'])) 
    {
        $email = $_POST['email'];
        $pass = ($_POST['password']);
        echo $email;
        echo $pass;

        $loginquery="SELECT * FROM admin WHERE userid='$email' AND pass='$pass'";
        $loginres = $conn->query($loginquery);

        echo $loginres->num_rows;

        if ($loginres->num_rows > 0) 
        {

            while ($result=$loginres->fetch_assoc()) 
            {
                $username=$result['userid'];
            }

            $_SESSION['username']=$username;
            $_SESSION['auth']=1;
            header("location:home.php");
        }
        else
        {
            echo "invalid";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />

    <link href="./css/Login_2.css" rel="stylesheet">
    <link href="./css/styles_2.css" rel="stylesheet">
    <link href="./css/main_2.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/home.css" rel="stylesheet">


    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<header>

    <div class="title2">
        <h2>Hardware Manager</h2>
        <hr></hr>
    </div>

</header>
<div class="container">

    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="./product_img/admin.jpg" alt="">
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form" id="login-form">
                <div class="title">Admin</div>
            <div class="card-body">
                <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" class="form-control" placeholder="username" name="email">
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" placeholder="password" name="password">
                        </div>

<!--                        <div class="form-check d-flex justify-content-start mb-4">-->
<!--                            <input class="form-check-input" type="checkbox" value="" id="form1Example3" />-->
<!--                            <label class="form-check-label" for="form1Example3" style="font-size: 15px"> Remember password </label>-->
<!--                        </div>-->
                        <div id="error">
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Log in" id="login" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>