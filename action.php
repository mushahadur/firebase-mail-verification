<?php
$pageTitle = "Register";
// include 'db_config.php';
include 'header.php';
$referId = isset($_GET['referId']) ? htmlspecialchars($_GET['referId']) : '';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_project_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['referral_code']) || empty($_POST['terms'])) {
        echo "All fields are required.";
        exit;
    }
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $referral_code = $_POST['referral_code'];
    $terms = $_POST['terms'];

    // Check if email already exists
    $sql = "SELECT * FROM register_user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email already registered.";

        echo "<script>
        if (localStorage.getItem('email')) {
            localStorage.removeItem('email');
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.removeItem('referral_code');
            localStorage.removeItem('terms');
        }
          </script>";
    } 
    else {
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
    
}

$conn->close();
