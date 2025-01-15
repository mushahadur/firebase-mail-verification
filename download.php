<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl">
        <?php if (!empty($message)): ?>
            <div class="bg-green-100 border text-xs border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <h2 class="text-2xl font-bold mb-4 text-center">Scan to Download</h2>
        <div class="flex justify-center mb-4">
            <img src="assets/images/qr_code.png" alt="QR Code" class="w-32 h-32">
        </div>
        <button type="submit"
            class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Download App <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</body>

</html>