<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Registration</title>
    <link rel="stylesheet" href="assets_pages/css/styles.css">
</head>
<body>
    <div class="registration-container">
        <form class="registration-form" id="ngoRegistrationForm">
            <h2>NGO Registration</h2>
            <p>Register your NGO to start receiving donations</p>
            <div class="form-group">
                <label for="ngo-name">NGO Name</label>
                <input type="text" id="ngo-name" name="ngo-name" placeholder="Enter your NGO name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your contact number" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address" required></textarea>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Register</button>
            <p class="login-link">Already registered? <a href="login.html">Login</a></p>
        </form>
    </div>
</body>
</html>