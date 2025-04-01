<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
</head>

<body>

    <div class="container" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="300" data-aos-offset="0" data-aos-duration="500">
        <div class="form-box active" id="login-form">
            <form action="">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="password" name="password" placeholder="Your password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#register-form">Register</a></p>
            </form>    
        </div>

        <div class="form-box" id="register-form">
            <form action="">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="password" name="password" placeholder="Your password" required>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#login-form">Login</a></p>
            </form>    
        </div>
    </div>    

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    
</body>
</html>