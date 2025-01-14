<?php
// Database connection
require 'db_config.php';
session_start();
$errors = ['email' => '', 'password' => ''];
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Email Validation
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    }
    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    }

    if (!array_filter($errors)) {
        // Check if email exists and verify password
        $sql = "SELECT * FROM register_user WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                header('Location: dashboard.php');
                exit();
            } else {
                $_SESSION['errors_message'] = "Invalid email or password.";
            }
        } else {
            $_SESSION['errors_message'] = "Invalid email or password.";
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
    }
    header('Location: login.php');
    exit();
}
$conn->close();
