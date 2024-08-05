<?php
require_once 'connection.php';

if (isset($_POST['submit'])) {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

   
    $errors = [];

    
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (is_numeric($name)) {
        $errors['name'] = 'Name must be a string';
    }

   
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is not valid';
    }

    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif ($password !== $confirmPassword) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

  
    if (!empty($errors)) {
        foreach ($errors as $key => $value) {
            $_SESSION['errors'][$key] = $value;
        }
        header('Location: register.php');
        exit();
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $sqlQuery = $connection->prepare($query);
        $sqlQuery->execute([$name, $email, $hashedPassword]);

       
        if ($sqlQuery) {
            $_SESSION['success'] = 'Registered successfully';
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['errors'] = ['Error while registering'];
            header('Location: register.php');
            exit();
        }
    }
} else {
    header('Location: register.php');
    exit();
}
?>
