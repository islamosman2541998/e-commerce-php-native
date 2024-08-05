<?php
require_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0px;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 20px 0px;
            background-color: #607d8b4a;
            font-family: Arial, sans-serif;
            background-color: #E0F2F1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .5)), url(./uploads/background.jfif);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .nav {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 0;
        }

        .nav .links {
            width: 15%;
            display: flex;
            justify-content: space-around;
        }

        .nav .links a {
            color: white;
            padding: 4px 10px;
            background-color: #03a9f47a;
            text-decoration: none;
            border-radius: 4px;
            transition: all 1s;
        }

        .input {
            outline: none;
            border: none;
            width: 300px;
            height: 45px;
            border-radius: 10px;
            padding: 10px;
        }

        .form {
            width: 430px;
            height: 500px;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.423);
            backdrop-filter: blur(30px);
            padding: 30px;
            -webkit-filter-blur: 10%;
            border-radius: 30px;
        }

        form button {
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            background-color: teal;
            transition: all 1s;
        }

        form span a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .remember {
            width: 135px;
            height: 32px;
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-around;
            align-items: center;
        }

        .errorMessage {
            font-size: 18px;
            color: #ef0000d4;
        }
        .nav {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 0;
        }

        .nav .links {
            width: 15%;
            display: flex;
            justify-content: space-around;
        }

        .nav .links a {
            color: black;
            padding: 10px 20px;
            background-color: #eee;
            text-decoration: none;
            border-radius: 4px;
            transition: all 1s;
        }
    </style>
</head>

<body>
<div class="nav">
        <div class="links">
            <a href="Login.php">Login</a>
        </div>
    </div>
    <div class="nav">
        <div class="links">
            <!-- <a href="Login.php">Log in</a> -->
            <!-- <a href="Register.php">Register</a> -->
        </div>
    </div>
    <div>
        <form class="form" action="handleRegister.php" method="post">
            <h3 style="color:#3C3C42;font-size:26px;">Register Here</h3>
            <input placeholder="Enter Name" class="input" type="text" name="name" value="">
            <input placeholder="Enter Email" class="input" type="email" name="email" value="">
            <input class="input" placeholder="Enter Password" type="password" name="password">
            <input class="input" placeholder="Confirm Password" type="password" name="confirm_password">
            <button type="submit" style="cursor: pointer;" name="submit">Register</button>

            <?php
            require_once 'connection.php';
            require_once 'inc/errors.php';
            ?>
        </form>
    </div>
</body>

</html>