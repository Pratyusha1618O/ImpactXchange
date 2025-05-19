<?php
session_start();
include("./server/config.php");

if (isset(($_POST['sub'])) && $_POST['sub'] == 'submit') {
    $user_email = $_POST["email"];
    $user_password = base64_encode($_POST["password"]);

    //check if already logged in
    // $checkSQL = "SELECT * FROM login where user_email = '$user_email' AND user_password = '$user_password' ";
    // $check_query = mysqli_query($dbcon, $checkSQL);

    // if($check_query->num_rows > 0) {
    //     $errorMsg = "Already logged in";
    //     // header("Location: user-dashboard.php");
    // }
    // else {
        //fetching data from user table
        $sql = "SELECT * FROM user WHERE user_email = '$user_email' AND user_password = '$user_password' ";
        $result = mysqli_query($dbcon, $sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['user_id'];
    
                // inserting data into login table
                // $loginSQL = "INSERT INTO login(user_id, user_email, user_password) 
                //         VALUES('$user_id','$user_email','$user_password' )";
    
                // $result2 = mysqli_query($dbcon, $loginSQL);
                $_SESSION['email'] = $row['user_email'];
    
                header("Location: user-dashboard.php");
                exit();
            }
        } else {
            $errorMsg = "Incorrect email or password!!";
        }
    // }
    
}
?>

<?php
include("header.php");
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            /* background: linear-gradient(-45deg, #F97316, #fff237, #f9f8f8); */
            background: linear-gradient(-45deg,rgb(196, 181, 255), #9ee4ff,rgb(255, 210, 210));

        }

        .container {
            display: flex;
            width: 800px;
            height: 500px;
            background-color: rgba(255, 255, 255, 0.9);
            /* Semi-transparent background */
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

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-group input:focus {
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

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #6a11cb;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <h2>Hello, Welcome!</h2>
            <p>Don't have an account?</p>
            <button onclick="window.location.href='user-registration.php'">Register</button>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h3>Login</h3>
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn" name="sub" value="submit">Login</button>

                <?php if (!empty($errorMsg)) { ?>
                    <p style="color: red; margin-top: 10px; text-align: center;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <?php echo $errorMsg; ?>
                    </p>
                <?php } ?>
                <p class="register-link">Forgot your password? <a href="#">Reset Password</a></p>
            </form>
        </div>
    </div>
</body>

</html>