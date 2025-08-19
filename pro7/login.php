<?php
/* Write a program for User Login System Using Sessions and Cookies. 
Do the Login validation using hardcoded credentials, “Remember Me” functionality using cookies, 
Session-based access control for the dashboard, Logout functionality. */

session_start();

$stored_email = "user@example.com";
$stored_password = "123456";

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if ($email === $stored_email && $password === $stored_password) {
        $_SESSION['user'] = $email;

        if ($remember) {
            setcookie("email", $email, time() + (86400 * 7));  // 7 days
        } else {
            setcookie("email", "", time() - 3600);
        }

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login with Session and Cookie</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f0f0f0; 
            padding: 50px; 
        }
        .box { 
            max-width: 400px; 
            margin: auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px #aaa; 
        }
        h2 { 
            text-align: center; 
        }
        input[type="email"], input[type="password"] {
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%; 
            padding: 10px; 
            background: #28a745; 
            color: white; 
            border: none; 
            border-radius: 5px;
        }
        .error { 
            background: #ffcdd2; 
            color: #c62828; 
            padding: 10px; 
            margin-bottom: 10px; 
            border-radius: 5px; 
        }
    </style>
</head>
<body>
<div class="box">
    <h2>User Login</h2>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>">
        <input type="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" name="remember" <?= isset($_COOKIE['email']) ? "checked" : "" ?>> Remember Me</label>
        <br><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>