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
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $profile_name = isset($_POST['profile_name']) ? $_POST['profile_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $referral_code = isset($_POST['referral_code']) ? $_POST['referral_code'] : '';
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Insert data into database
    $sql = "INSERT INTO register_user (email, profile_name, username, password, referral_code, terms) 
            VALUES ('$email', '$profile_name ', $username', '$password', '$referral_code', '$terms')";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['message'] = "Your Registration successful!";
        echo "<script>
            localStorage.removeItem('email');
            localStorage.removeItem('profile_name');
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.removeItem('referral_code');
            localStorage.removeItem('terms');
            window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
