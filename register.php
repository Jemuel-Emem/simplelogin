<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username already exists
    $check_sql = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Username exists, show an error
        echo "<p class='text-red-500 text-center'>Username already taken. Please choose a different one.</p>";
    } else {
        // Insert the new user if the username is unique
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! <a href='login.php' class='text-blue-500'>Login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background: rgba(0, 0, 139, 0.4); 
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
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Register</h2>

        <form method="POST" class="flex flex-col space-y-4">
            <label for="username" class="text-left text-gray-600 font-medium">Username</label>
            <input type="text" id="username" name="username" required class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <label for="password" class="text-left text-gray-600 font-medium">Password</label>
            <input type="password" id="password" name="password" required class="p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <button type="submit" class="mt-6 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">Register</button>
        </form>

        <p class="mt-4 text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a></p>
    </div>

</body>
</html>
