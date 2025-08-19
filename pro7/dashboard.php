<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { 
            font-family: Arial; 
            padding: 40px; 
            background: #e8f5e9; 
        }
        .dashboard { 
            max-width: 600px; 
            margin: auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px #aaa; 
        }
        h2 { 
            color: #2e7d32; 
        }
        a { 
            display: inline-block; 
            margin-top: 20px; 
            background: #c62828; 
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 5px; 
        }
    </style>
</head>
<body>
<div class="dashboard">
    <h2>Welcome to the Dashboard</h2>
    <p>You are logged in as: <strong><?= $_SESSION['user'] ?></strong></p>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>