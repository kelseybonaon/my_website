<?php
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; 
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['user'] = $user;
        if ($user['role'] == 'admin') {
            header('Location: admin.php'); 
        } else {
            header('Location: user.php'); 
        }
    } else {
        
        echo "Invalid login details!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
            background-color: #f4f4f4; 
        }

        form {
            background: white; 
            padding: 20px;
            border-radius: 5px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            max-width: 400px; 
            width: 100%; 
        }

        h2 {
            text-align: center; 
        }

        label {
            display: block; 
            margin-bottom: 5px; 
        }

        input {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 3px; 
            box-sizing: border-box; 
        }

        button {
            width: 100%; 
            padding: 10px; 
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 3px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #45a049; 
        }

        a {
            display: block; 
            text-align: center; 
            margin-top: 10px; 
            text-decoration: none; 
            color: #007BFF; 
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
        <a href="register.php">Register</a>
    </form>
</body>
</html>
