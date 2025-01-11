<?php
$pageTitle = "Register";
session_start();
include 'header.php';
include 'db_config.php';

$errors = ['username' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'terms' => ''];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $referral_code = isset($_POST['referral_code']) ? $_POST['referral_code'] : '';
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Username Validation
    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $errors['username'] = "Username must be between 3 and 20 characters.";
    }

    // Email Validation
    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } elseif (!preg_match("/@(gmail\.com|outlook\.com|yahoo\.com)$/", $email)) {
        $errors['email'] = "Email must be a valid Gmail, Outlook, or Yahoo address.";
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters.";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors['password'] = "Password must include at least one uppercase letter.";
    } elseif (!preg_match("/[a-z]/", $password)) {
        $errors['password'] = "Password must include at least one lowercase letter.";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Password must include at least one number.";
    } elseif (!preg_match("/[\W_]/", $password)) {
        $errors['password'] = "Password must include at least one special character.";
    }

    // Validate Confirm Password
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Terms Validation
    if (empty($terms)) {
        $errors['terms'] = "You must agree to the terms and conditions.";
    }

    if (!array_filter($errors)) {

        // Check if email already exists
        $sql = "SELECT * FROM register_user WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<script>
        if (localStorage.getItem('email')) {
            localStorage.removeItem('email');
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.removeItem('referral_code');
            localStorage.removeItem('terms');
        }
        </script>";
            $_SESSION['message'] = "Email already registered, Please enter a new email address.";
            header('Location: register.php');
        } else {
            echo "
                <script type='module'>
                    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js';
                    import { getAuth, sendSignInLinkToEmail } from 'https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js';
            
                    // Firebase configuration
                    const firebaseConfig = {
                        apiKey: 'AIzaSyCCbQ_JqGk88DDI1rG3l379_djP05c4hvQ',
                        authDomain: 'email-auth-500a9.firebaseapp.com',
                        projectId: 'email-auth-500a9',
                        storageBucket: 'email-auth-500a9.firebasestorage.app',
                        messagingSenderId: '412003158891',
                        appId: '1:412003158891:web:7922aa6e43594878711a2e',
                        measurementId: 'G-H7CD4TCTNW'
                    };
            
                    // Initialize Firebase
                    const app = initializeApp(firebaseConfig);
                    const auth = getAuth(app);
            
                    // Action code settings for the magic link
                    const actionCodeSettings = {
                        url: 'http://localhost/firebase/new-project/register.html',
                        handleCodeInApp: true,
                    };
            
                    // Send magic link
                    const email = '$email';
                    sendSignInLinkToEmail(auth, email, actionCodeSettings)
                        .then(() => {
                            localStorage.setItem('emailForSignIn', email);
                            localStorage.setItem('email', '$email');
                            localStorage.setItem('username', '$username');
                            localStorage.setItem('password', '$password');
                            localStorage.setItem('referral_code', '$referral_code');
                            localStorage.setItem('terms', '$terms');
                        })
                        .catch((error) => {
                            localStorage.removeItem('email');
                            localStorage.removeItem('username');
                            localStorage.removeItem('password');
                            localStorage.removeItem('referral_code');
                            localStorage.removeItem('terms');
                            console.error('Error sending magic link:', error.message);
                            alert('Error: ' + error.message);
                        });
                </script>";
            // Include the email verification page
            include 'email-check.html';
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: register.php');
        exit();
    }
}

$conn->close();
