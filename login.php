<?php
$pageTitle = "Login";
// include 'db_config.php';
include 'header.php';

session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$errors_message = isset($_SESSION['errors_message']) ? $_SESSION['errors_message'] : '';
session_unset();
?>

<div class="container pt-32">
    <div class="flex justify-center">
        <div class="col-lg-12">
            <?php if (!empty($errors_message)): ?>
                <div class="bg-red-100 border text-xs border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <?php echo htmlspecialchars($errors_message); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($message)): ?>
                <div class="bg-green-100 border text-xs border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            <div class=" max-w-md p-8 space-y-6 bg-white shadow-xl rounded-lg">
                <h1 class="text-4xl font-bold text-black mb-2">Sign In.</h1>
                <p class="text-sm text-gray-700 mb-4">You don't have an account? <a href="register.php"
                        class="text-green-500 font-bold">Register</a></p>
                <form class="space-y-4" action="signin.php" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="email"><i
                                class="fas fa-envelope"></i>
                            Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Enter Your Email Address">
                        <?php if (!empty($errors['email'])): ?>
                            <div class="text-xs text-red-400"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="password"><i
                                class="fas fa-lock"></i>
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Enter Your Password">
                            <?php if (!empty($errors['password'])): ?>
                                <div class="text-xs text-red-400"><?php echo $errors['password']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Sign in <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    localStorage.removeItem('email');
    localStorage.removeItem('username');
    localStorage.removeItem('password');
    localStorage.removeItem('referral_code');
    localStorage.removeItem('terms');
</script>"
<?php
include 'footer.php';
?>