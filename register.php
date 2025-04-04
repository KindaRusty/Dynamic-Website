<?php

session_start();
require 'settings.php';

$message = "";

if (isset($_POST["register"])) {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT * FROM managers WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $message = "Username already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO managers (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            $message = "Registration successful! Please log in.";
        } else {
            $message = "Registration failed, please try again!";
        }
    }
}

if (isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM managers WHERE username = ?");
    $stmt->execute([$username]);
    $manager = $stmt->fetch();

    if ($manager && password_verify($password, $manager["password"])) {
        $_SESSION["manager"] = $username;

        if ($username === "admin") {

            header("Location: manage.php");
        } else {
            header("Location: jobs.php");
        }
        exit();
    } else {
        $message = "Incorrect username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>  

<form method="post">
    <h3>Login or Register</h3>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <label for="username" class="sr-only">Username</label>
    <input type="text" name="username" id="username" placeholder="Username" required>
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" placeholder="Password" required>
    
    <button type="submit" name="login">Login</button>
    <button type="submit" name="register">Register</button>
</form>

</body>
</html>