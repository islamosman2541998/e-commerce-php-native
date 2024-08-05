<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #E0F2F1;
            display: flex;
            justify-content: start;
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
            color: black;
            padding: 10px 20px;
            background-color: #eee;
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
            height: 325px;
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

        .error {
            color: red;
        }

        .errorMessage {
            padding: 10px;
            margin: 10px 0px;
            text-align: center;
            border-radius: 20px;
            color: black;
            background-color: #fc9393b8;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="links">
            <a href="register.php">Register</a>
        </div>
    </div>
    <div>
        <?php
        require_once 'connection.php';
        require_once 'inc/errors.php';
        require_once 'inc/success.php';
        ?>

        <form class="form" action="handleLogin.php" method="post">
            <h3 style="color:#3C3C42;font-size:26px;">Login Here</h3>
            <input placeholder="Enter Email" class="input" type="email" name="email" id="">
            <input class="input" placeholder="Enter Password" type="password" name="password" id="">
            <button type="submit" style="cursor: pointer;" name="submit">Login</button>

            <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) {
                    echo "<p class='errorMessage' >$error</p>";
                }
                unset($_SESSION['errors']);
            }

            if (isset($_SESSION['success'])) {
                echo "<p class='success'>{$_SESSION['success']}</p>";
                unset($_SESSION['success']);
            }
            ?>
        </form>
    </div>
</body>

</html>