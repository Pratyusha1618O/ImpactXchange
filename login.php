<?php
    session_start();

    include("header.php");
    include("./server/config.php");


    if(isset($_POST['sub'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $email = $_POST['email'];
            $password = base64_encode($_POST['password']);

            $sql = "SELECT * FROM user WHERE user_email='$email' AND user_password='$password'";
            $result = mysqli_query($dbcon, $sql);

            if(mysqli_num_rows($result) == 1){
                $user = mysqli_fetch_assoc($result);

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['user_email'];

                header('Location: dashboard.php'); // redirect to dashboard
                exit();
            } else {
                $error = "Invalid Email or Password!";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets_pages/css/styles.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" id="loginForm" method="POST">
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn" name="sub" value="submit">Login</button>
            <!-- <div class="alert" id="alert" style="display: none;"></div> -->
            <p class="signup-link">Don't have an account? <a href="./user-registration.php">Sign up</a></p>

            <div class="alert" id="alert" style="display: <?php echo isset($error) ? 'block' : 'none'; ?>; color: red;">
            <?php if(isset($error)) echo $error; ?>
</div>

        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>