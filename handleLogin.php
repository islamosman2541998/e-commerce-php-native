<?php
session_start(); 
require_once 'connection.php'; 
if (isset($_POST['submit'])) {

    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not valid';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit();
    }

    $query = "SELECT * FROM users WHERE `email` = :email";
    $sqlQuery = $connection->prepare($query);
    $sqlQuery->execute(['email' => $email]);

    $user = $sqlQuery->fetch(PDO::FETCH_ASSOC);

    if ($sqlQuery->rowCount() == 1) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['success'] = 'Logged in successfully. Welcome ' . $user['name'];

            header('Location: index.php?id=' . $user['id']); 
            exit();
        } else {
            $_SESSION['errors'] = ['Password is not correct'];
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['errors'] = ['User not found'];
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
