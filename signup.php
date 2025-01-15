<?php
// Database connection
require 'db_config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {

        session_start();
        $_SESSION['message'] = "Session time out, Please try again registration.";
        header('Location: register.php');
        exit();
    }
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $profile_name = trim($_POST['profile_name']);
    $password = trim($_POST['password']);
    $referral_code = trim($_POST['referral_code']);
    $terms = trim($_POST['terms']);

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $sql = "INSERT INTO register_user (profile_name, username, email, password, referral_code, terms) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $profile_name, $username, $email, $hashedPassword, $referral_code, $terms);
        $stmt->execute();
        session_start();
        $_SESSION['message'] = "Your Registration successful!";
        echo "<script>
            localStorage.removeItem('email');
            localStorage.removeItem('profile_name');
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.removeItem('referral_code');
            localStorage.removeItem('terms');
            window.location.href = 'download.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
