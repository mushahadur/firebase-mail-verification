<?php
$pageTitle = "Register";
include 'header.php';

$referId = isset($_GET['referId']) ? htmlspecialchars($_GET['referId']) : '';
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
session_unset();
?>

<div class="container pt-32">
    <div class="flex justify-center">
        <div class="col-lg-12">
            <?php if (!empty($message)): ?>
                <div class="bg-red-100 border text-xs border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            <div class=" max-w-md p-8 space-y-6 bg-white shadow-xl rounded-lg">
                <h1 class="text-4xl font-bold text-black mb-2">Sign Up.</h1>
                <p class="text-sm text-gray-700 mb-4">Already have an account? <a href="login.php"
                        class="text-green-500 font-bold">Login</a></p>
                <form class="space-y-4" action="action.php" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="email"><i
                                class="fas fa-envelope"></i>
                            Email</label>
                        <input type="email" id="email" name="email"
                         value="<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Email">
                        <?php if (!empty($errors['email'])): ?>
                            <div class="text-xs text-red-400"><?php echo $errors['email']; ?></div>
                        <?php else: ?>
                            <p class="mt-1 text-xs text-gray-500">Please make sure your email address is correct so we can get in touch with you.</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="username"><i
                                class="fas fa-user"></i>
                            Username</label>
                        <input type="text" id="username" name="username"
                         value="<?php echo isset($form_data['username']) ? htmlspecialchars($form_data['username']) : ''; ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Username">
                        <div class="flex gap-2 items-center">
                            <button type="button" class="mt-1 text-xs text-green-500 font-bold"
                                id="generateUsername">Generate Username</button>
                            <?php if (!empty($errors['username'])): ?>
                                <div class="text-xs text-red-400 pt-1"><?php echo $errors['username']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="password"><i
                                class="fas fa-lock"></i>
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                             value="<?php echo isset($form_data['password']) ? htmlspecialchars($form_data['password']) : ''; ?>"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Password">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <i class="fas fa-eye cursor-pointer" id="togglePassword"></i>
                            </span>
                        </div>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="text-xs text-red-400"><?php echo $errors['password']; ?></div>
                            <?php else: ?>
                        <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters, uppercase, lowercase, number, special characters.</p>
                    <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="confirm-password"><i
                                class="fas fa-lock"></i>
                            Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="confirm-password" name="confirm_password"
                             value="<?php echo isset($form_data['confirm_password']) ? htmlspecialchars($form_data['confirm_password']) : ''; ?>"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Confirm Password">
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <i class="fas fa-eye cursor-pointer" id="toggleConfirmPassword"></i>
                            </span>
                            <?php if (!empty($errors['confirm_password'])): ?>
                                <div class="text-xs text-red-400"><?php echo $errors['confirm_password']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="referral-code">Referral
                            Code</label>
                        <input type="text" id="referral-code"
                            name="referral_code"
                              value="<?php echo $referId; ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            placeholder="Referral Code">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-10">
                            <input id="terms" name="terms" type="checkbox"
                                class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 pt-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#"
                                    class="text-green-500">Terms &
                                    Conditions and Privacy Policy</a>
                                <?php if (!empty($errors['terms'])): ?>
                                    <div class="text-xs text-red-400"><?php echo $errors['terms']; ?></div>
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
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

<?php include 'footer.php'; ?>