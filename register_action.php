<?php
session_start();
include "db.php";

if (isset($_POST['register'])) {

    $name             = trim($_POST['name']);
    $email            = trim($_POST['email']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    /* EMPTY CHECK */
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    /* EMAIL EXISTS CHECK */
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Email already registered!";
        header("Location: register.php");
        exit();
    }

    /* PASSWORD HASH */
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    /* INSERT USER */
    $sql = "INSERT INTO users (username, email, password, role)
            VALUES ('$name', '$email', '$hashed_password', 'user')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Registration successful! You can login now.";
        header("Location: register.php");
        exit();
    } else {
        $_SESSION['error'] = "Registration failed. Try again!";
        header("Location: register.php");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
