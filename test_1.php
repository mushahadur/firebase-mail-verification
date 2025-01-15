<?php
session_start();
require 'db_config.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {

        echo "all fields are required";
        exit();
    }
    // Retrieve and sanitize inputs
    $email = trim($_POST['email']);
    $name = trim($_POST['username']);
    $password = trim($_POST['password']);
    // echo "<pre>";
    // print_r($email);
    // print_r($name);
    // print_r($password);
    // echo "</pre>";
    // exit();
    if (strlen($name) < 3 || strlen($name) > 20) {
        die("name must be between 3 and 20 characters.");
    }

    if (strlen($password) <4) {
        die("Password must be at least 8 characters.");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        $stmt->execute();
        echo "Signup successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    die("Invalid request method.");
}
