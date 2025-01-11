<?php
$pageTitle = "Register";
// include 'db_config.php';
include 'header.php';
$referId = isset($_GET['referId']) ? htmlspecialchars($_GET['referId']) : '';

?>

<div class="container pt-32">
    <div class="flex justify-center">
        <div class="col-lg-12">
            <div class=" max-w-md p-8 space-y-6 bg-white shadow-xl rounded-lg">
                <h1 class="text-4xl font-bold text-black mb-2">Sign Up.</h1>
                <p class="text-sm text-gray-700 mb-4">Already have an account? <a href="#"
                        class="text-green-500 font-bold">Login</a></p>
                <form class="space-y-4" action="action.php" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="email"><i class="fas fa-envelope"></i>
                            Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Email">
                        <p class="mt-1 text-xs text-gray-500">Please make sure your email address is correct so we can get in
                            touch with
                            you.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="username"><i class="fas fa-user"></i>
                            Username</label>
                        <input type="text" id="username" name="username"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Username">
                        <button type="button" class="mt-1 text-xs text-green-500 font-bold" id="generateUsername">Generate Username</button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="password"><i class="fas fa-lock"></i>
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Password">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <i class="fas fa-eye cursor-pointer" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="confirm-password"><i
                                class="fas fa-lock"></i>
                            Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="confirm-password" name="confirm_password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Confirm Password">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <i class="fas fa-eye cursor-pointer" id="toggleConfirmPassword"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="referral-code">Referral Code</label>
                        <input type="text" id="referral-code"
                            name="referral_code"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Referral Code"
                            value="<?php echo $referId; ?>">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox"
                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#"
                                    class="text-green-500">Terms &
                                    Conditions and Privacy Policy</a></label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="updates" name="updates" type="checkbox"
                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="updates" class="font-medium text-gray-700">I agree to receive updates about products and
                                services,
                                promotions, special offers, news & events from Grass.</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" id="register-link"
                            class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            REGISTER <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="module">
    // Import the functions you need from the SDKs you need
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
    import {
        getAuth,
        sendSignInLinkToEmail
    } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyCCbQ_JqGk88DDI1rG3l379_djP05c4hvQ",
        authDomain: "email-auth-500a9.firebaseapp.com",
        projectId: "email-auth-500a9",
        storageBucket: "email-auth-500a9.firebasestorage.app",
        messagingSenderId: "412003158891",
        appId: "1:412003158891:web:7922aa6e43594878711a2e",
        measurementId: "G-H7CD4TCTNW"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const actionCodeSettings = {
        url: 'http://localhost/firebase/new-project/register.html',
        handleCodeInApp: true,
    };
    const sendEmailBtn = document.getElementById('send-magic-link');
    sendEmailBtn.addEventListener('click', (event) => {
        event.preventDefault();
        // alert('Sending email...');
        const email = document.getElementById('email').value;


        sendSignInLinkToEmail(auth, email, actionCodeSettings)
            .then(() => {
                window.localStorage.setItem('emailForSignIn', email);
                // alert('Sending email success');
            })
            .catch((error) => {
                const errorCode = error.code;
                const errorMessage = error.message;
                console.error(errorCode, errorMessage);
                alert(errorMessage);
            });
    });

    // Generate Username
    document.getElementById('generateUsername').addEventListener('click', () => {
        const usernameInput = document.getElementById('username');
        usernameInput.value = 'user_' + Math.random().toString(36).substring(2, 10);
    });

    // Toggle Password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#confirm-password');

    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        toggleConfirmPassword.classList.toggle('fa-eye-slash');
    });
</script>
<?php
include 'footer.php';
?>