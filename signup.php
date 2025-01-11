<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "my_project_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['referral_code']) || empty($_POST['terms'])) {
        
        session_start();
        $_SESSION['message_requird'] = "All fields are required.";
        header('Location: login.php');
        exit();
    }
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $referral_code = isset($_POST['referral_code']) ? $_POST['referral_code'] : '';
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Insert data into database
    $sql = "INSERT INTO register_user (email, username, password, referral_code, terms) 
            VALUES ('$email', '$username', '$password', '$referral_code', '$terms')";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['message'] = "Your Registration successful!";
        header('Location: login.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
