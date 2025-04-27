<?php
    include("header.php");
    include("./server/config.php");

    if(isset($_POST['submit'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $passsword = $_POST['password'];
            $confirm_passsword = $_POST['confirm-password'];

            if($passsword != $confirm_passsword){
                echo '<p style="display: block" name="password-match">Password not matched</p>';
            }
            else{
                $password = base64_encode($_POST['password']);

                $sql = "INSERT IGNORE INTO user(user_name, user_email, user_contact, user_password)
                VALUES('$username','$email','$contact','$password')";
    
                $query = mysqli_query($dbcon, $sql);

                // if($query){
                //     echo "<h3>Record inserted successfully.</h3>";
                // }else{
                //     echo "error!".$dbcon->error;
                // }
            }
    
            
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="assets_pages/css/styles.css">
</head>
<body>
    <div class="registration-container">
        <form class="registration-form" id="userRegistrationForm" method="POST">
            <h2>User Registration</h2>
            <p>Create your account to start donating</p>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="contact" id="contact" name="contact" placeholder="contact no." required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
            </div>
            <p style="display: none" name="password-match">Password not matched</p>
            <button type="submit" class="btn" name="submit">Register</button>
            <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>