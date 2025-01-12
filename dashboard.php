<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 shadow-md">
            <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <div class="flex items-center">
                <span class="mr-4 text-lg">Pulock</span>
                <a href="logout.php" class="bg-white text-blue-600 px-4 py-2 rounded-full shadow hover:bg-gray-100 transition duration-300">Logout</a>
            </div>
            </div>
        </header>
        <main class="flex-grow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-2">Card 1</h2>
                    <p class="text-gray-700">Content for card 1.</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-2">Card 2</h2>
                    <p class="text-gray-700">Content for card 2.</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-2">Card 3</h2>
                    <p class="text-gray-700">Content for card 3.</p>
                </div>
            </div>
        </main>
        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; 2025 Your Company</p>
        </footer>
    </div>
</body>
</html>