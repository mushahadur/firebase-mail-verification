<?php
session_start();
if (!isset($_SESSION['firebase_data'])) {
    header('Location: register.php');
    exit();
}

$firebaseData = $_SESSION['firebase_data'];
$email = $firebaseData['email'];
$password = $firebaseData['password'];
$username = $firebaseData['username'];
$referral_code = $firebaseData['referral_code'];
$terms = $firebaseData['terms'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Magic Link</title>
    <script type="module">
        import {
            initializeApp
        } from 'https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js';
        import {
            getAuth,
            sendSignInLinkToEmail
        } from 'https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js';

        const firebaseConfig = {
            apiKey: 'AIzaSyD1dqVHlhs3gnkBMAZxnx5Fea9W-EKzwK4',
            authDomain: 'mail-verification-66b20.firebaseapp.com',
            projectId: 'mail-verification-66b20',
            storageBucket: 'mail-verification-66b20.firebasestorage.app',
            messagingSenderId: '25030184594',
            appId: '1:25030184594:web:d8acc2a942f0d31792e04b',
            measurementId: 'G-KV8KDBPSYD'
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        const actionCodeSettings = {
            url: 'http://localhost/firebase-mail-verification/register.html',
            handleCodeInApp: true,
        };

        const email = '<?php echo $email; ?>';
        const username = '<?php echo $username; ?>';
        const password = '<?php echo $password; ?>';
        const referral_code = '<?php echo $referral_code; ?>';
        const terms = '<?php echo $terms; ?>';

        sendSignInLinkToEmail(auth, email, actionCodeSettings)
            .then(() => {
                localStorage.setItem('emailForSignIn', email);
                localStorage.setItem('email', email);
                localStorage.setItem('username', username);
                localStorage.setItem('password', password);
                localStorage.setItem('referral_code', referral_code);
                localStorage.setItem('terms', terms);
            })
            .catch((error) => {
                console.error('Error sending magic link:', error.message);
                alert('Error: ' + error.message);
                window.location.href = 'register.php';
            });
    </script>
    <title>Check Your Email</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body class="font-sans antialiased">
    <div class="pt-16">
        <div class="flex justify-center">
            <div class="col-lg-12">
                <div class="max-w-md p-8 space-y-6 bg-white shadow-xl rounded-lg">
                    <h1 class="text-xl text-center font-bold text-black mb-2">Check your provided email adress</h1>
                    <p class="text-md text-center text-green-500 mb-4">Click the button for go to mail inbox.</p>

                    <div>
                        <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"
                            class="w-full flex justify-center uppercase items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Clirk Here <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>