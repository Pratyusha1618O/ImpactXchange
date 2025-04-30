<?php
    // session_start();
    include("./server/config.php");

    if(isset($_SESSION['email'])){
        include("user_logged_in_nav.php");
    }
    else if(isset($_SESSION["admin-email"])){
        include("admin_loggedin_nav.php");    
    }
    else{
        include("header.php");
    }

    if (isset($_POST['submit'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ngo_name = $_POST['ngo-name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $regno = $_POST['registration-number'];
            $address = $_POST['address'];
            $password = base64_encode($_POST['password']);

            // Check for duplicate email or contact or regno
            $checkSQL = "SELECT * FROM ngo WHERE ngo_email = '$email' OR ngo_contact ='$contact' OR ngo_regno = '$regno' ";
            $check_query = mysqli_query($dbcon, $checkSQL);

            if($check_query->num_rows > 0){
                $errorMsg = "Already registered entries. Try logging in.";
            }
            else{
                //fetching data from ngo table. If an ngo already exists, it should not reg again
                $sql = "SELECT * FROM ngo where ngo_email = '$email' AND ngo_password = '$password' ";
                $check_result = mysqli_query($dbcon, $sql);

                if($check_result->num_rows > 0){
                    $errorMsg = "NGO already registered. Please login.";
                }
                else{
                    // new ngo's data inserting into ngo table
                    $sql = "INSERT INTO ngo(ngo_name,ngo_regno, ngo_email, ngo_contact, ngo_address, ngo_password)
                    VALUES('$ngo_name','$regno','$email','$contact','$address','$password')";
        
                    $query = mysqli_query($dbcon, $sql);

                    if($query){
                        $success = "✅NGO Registration successful, login to your account.";
                    }else{
                        $errorMsg = "Already registered entries. Try logging in.";
                    }
                }

            }

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 2rem;
            background: linear-gradient(-45deg, #F97316, #fff237, #f9f8f8);

        }
        .container {
            display: flex;
            width: 800px;
            height: 650px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .left-section {
            flex: 1;
            background-color: #6a11cb;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .left-section h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .left-section p {
            font-size: 1em;
            margin-bottom: 20px;
        }
        .left-section button {
            background-color: #ffffff;
            color: #6a11cb;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .left-section button:hover {
            background-color: #e6e6e6;
        }
        .right-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-section h3 {
            font-size: 1.8em;
            color: #6a11cb;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        .form-group textarea {
            resize: none;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }
        .btn {
            background-color: #6a11cb;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #357ab8;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #6a11cb;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <h2>Welcome Back!</h2>
            <p>Already registered?</p>
            <button onclick="window.location.href='./ngo-login.php'">Login</button>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h3>NGO Registration</h3>
            <form id="ngoRegistrationForm" method="POST">
                <div class="form-group">
                    <label for="ngo-name">NGO Name</label>
                    <input type="text" id="ngo-name" name="ngo-name" placeholder="Enter your NGO name" required>
                </div>
                <div class="form-group">
                    <label for="registration-number">Registration Number</label>
                    <input type="text" id="registration-number" name="registration-number" placeholder="Enter your registration number" required>
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
                    <label for="address">NGO Address</label>
                    <textarea id="address" name="address" rows="1" placeholder="Enter your NGO address" required></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="btn" name="submit" value="submit">Register</button>

                <?php if(!empty($success)) {?>
                    <p style="color: green; margin-top: 10px; text-align: center;">
                        <?php echo $success; ?>
                    </p>
                <?php }?>
                <?php if(!empty($errorMsg)) {?>
                    <p style="color: red; margin-top: 10px; text-align: center;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                        <?php echo $errorMsg; ?>
                    </p>
                <?php }?>
            </form>
        </div>
    </div>
</body>
</html>