<?php
/* Write a program for User Registration with Exception Handling. 
Accept name, email, and password, Validate inputs, throws exceptions for
empty fields or invalid email and displays appropriate error/success messages.*/

function validateRegistration($name, $email, $password) {
    if (empty($name) || empty($email) || empty($password)) {
        throw new Exception("All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format.");
    }
    if (strlen($password) < 6) {
        throw new Exception("Password must be at least 6 characters.");
    }
    return true;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    try {
        validateRegistration($name, $email, $password);
        $success = "Registration successful for $name!";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { 
            font-family: sans-serif; 
            background: #eef1f5; 
            padding: 30px; 
        }
        .form-box { 
            width: 400px; 
            background: #fff; 
            padding: 25px; 
            margin: auto; 
            border-radius: 10px; 
            box-shadow: 0 0 12px #ccc; 
        }
        input { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
        }
        input[type="submit"] { 
            background: #2196F3; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        .error { 
            color: #b71c1c; 
            background: #ffcdd2; 
            padding: 10px; 
            margin-top: 15px; 
        }
        .success { 
            color: #1b5e20; 
            background: #c8e6c9; 
            padding: 10px; 
            margin-top: 15px; 
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>User Registration</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Enter name" required>
        <input type="email" name="email" placeholder="Enter email" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <input type="submit" value="Register">
    </form>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>
</div>

</body>
</html>