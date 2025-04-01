<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login & Register Page</title>
</head>

<body>
    <div class="container" id="container">
        <!-- Toggle Container (Left Side) -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                </div>
            </div>
        </div>

        <!-- Sign-Up Form -->
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <span>Register with Username</span>
                <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
                <input type="text" name="username" placeholder="Enter your Username" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- Sign-In Form -->
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>
                <span>Login With Username</span>
                <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
                <input type="text" name="username" placeholder="Enter Username" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>