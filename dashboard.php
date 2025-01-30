<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Background with blur effect */
        body {
            position: relative;
            height: 100vh;
            background: url('images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }

        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); 
            backdrop-filter: blur(8px); 
            z-index: -1;
        }

        .container {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <div class="w-full bg-gray-800 text-white text-center py-4 flex justify-between px-8 items-center">
        <span class="text-lg font-semibold">Logged in as: <?php echo $_SESSION['username']; ?></span>
        <a href="logout.php" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
    </div>   

    <div class="flex justify-center mt-8 container">
        <div class="p-8 rounded-lg max-w-7xl text-center bg-white bg-opacity-70 shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800">Welcome to My Website</h1>
            <p class="text-gray-600 mt-4">This is a simple and user-friendly platform designed to enhance your experience. Here, you can navigate seamlessly through our services, explore various features, and make the most out of our intuitive design.</p>
            <p class="text-gray-600 mt-2">We aim to provide the best experience possible, ensuring that your time here is both productive and enjoyable.</p>
        </div>
    </div>

</body>
</html>
