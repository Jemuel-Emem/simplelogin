<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

 
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);  
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p class='text-red-500 text-center'>Invalid credentials</p>";
        }
    } else {
        echo "<p class='text-red-500 text-center'>User not found</p>";
    }

    $stmt->close(); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      
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
            background: rgba(0, 0, 139, 0.4); /* Blue overlay with reduced opacity */
            z-index: -1;
        }

        @keyframes backgroundAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Login</h2>
        <form method="POST" class="mt-4 flex flex-col">
            <label class="text-left text-gray-600 font-medium">Username</label>
            <input type="text" name="username" required class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <label class="mt-4 text-left text-gray-600 font-medium">Password</label>
            <input type="password" name="password" required class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <button type="submit" class="mt-6 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
            <a href="register.php" class="text-gray-500 mt-2">Don't have an account?</a>
        </form>
    </div>

</body>
</html>
