<?php
    include("header.php");
    include("./server/config.php");

    if (isset($_POST['submit'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ngo_name = $_POST['ngo-name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $regno = $_POST['regno'];
            $address = $_POST['address'];
            $password = base64_encode($_POST['password']);

            $sql = "INSERT IGNORE INTO ngo(ngo_name, ngo_email, ngo_contact, ngo_regno, ngo_address, ngo_password)
                    VALUES('$ngo_name','$email','$contact','$regno','$address','$password')";

            $query = mysqli_query($dbcon, $sql);

            // if($query){
            //     echo "<h3>Record inserted successfully.</h3>";
            // }else{
            //     echo "error!".$dbcon->error;
            // }



        }
    }
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
        <form class="registration-form" id="ngoRegistrationForm" method="POST">
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
                <label for="regno">NGO Registration Number</label>
                <input type="text" id="regno" name="regno" placeholder="Enter registration no." required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your address" required></textarea>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn" name="submit">Register</button>
            <p class="login-link">Already registered? <a href="login.html">Login</a></p>
        </form>
    </div>
</body>

</html>