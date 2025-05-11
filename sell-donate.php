<?php
session_start();
include("./server/config.php");

if (isset($_SESSION['email'])) {
    include("user_logged_in_nav.php");
    $email = $_SESSION['email'];
} elseif (isset($_SESSION["ngo-email"])) {
    include("ngo_loggedin_nav.php");
    $email = $_SESSION['ngo-email'];
} elseif (isset($_SESSION["admin-email"])) {
    include("admin_loggedin_nav.php");
    $email = $_SESSION['admin-email'];
} else {
    include("header.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $product_name = $_POST['productName'];
    $product_details = $_POST['productDetails'];
    $product_price = $_POST['productCost'];
    $product_type = $_POST['productCategory'];

    $userID_sql = "SELECT user_id FROM user WHERE user_email = '$email'";
    $userResult = mysqli_query($dbcon, $userID_sql);

    if ($userRow = mysqli_fetch_assoc($userResult)) {
        $user_id = $userRow['user_id'];

        $filename = $_FILES['productImage']['name'];
        $tempfile = $_FILES['productImage']['tmp_name'];
        $folder = "product_images/" . basename($filename);

        if (!empty($filename)) {
            $today_date = date("Y-m-d");

            $insert_sql = "INSERT INTO product (user_id, product_name, product_details, product_price, product_type, product_img, donation_date) 
                           VALUES ('$user_id', '$product_name', '$product_details', '$product_price', '$product_type', '$filename', '$today_date')";
            $result = mysqli_query($dbcon, $insert_sql);

            if ($result) {
                move_uploaded_file($tempfile, $folder);
                echo "<script>alert('Product uploaded successfully!');</script>";
            } else {
                echo "<script>alert('Database Error: " . mysqli_error($dbcon) . "');</script>";
            }
        } else {
            echo "<script>alert('Please upload an image.');</script>";
        }
    } else {
    echo "<script>
        alert('User not found. Please register first.');
        window.location.href = 'user-registration.php';
    </script>";
    exit();
}
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell/Donate Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin-top: 2rem;
            font-family: 'Roboto', Arial, sans-serif;
            /* margin: 0; */
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* background: linear-gradient(-45deg,rgb(118, 84, 255),rgb(158, 228, 255), #f9f8f8); */
            background: linear-gradient(-45deg, #F97316, #fff237, #f9f8f8);

        }

        .container {
            display: flex;
            width: 900px;
            height: auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
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
            flex: 2;
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

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        .form-group textarea {
            resize: none;
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

        .upload-section input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h2>Welcome!</h2>
            <p>Want to donate or sell a product?</p>
            <a href="product-list.php"><button>View Products</button></a>
        </div>

        <form method="POST" action="sell-donate.php" enctype="multipart/form-data">
            <div class="right-section">
                <h3>Sell/Donate Product</h3>

                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="productName" placeholder="Enter product name" required>
                </div>

                <div class="form-group">
                    <label for="productDetails">Product Details</label>
                    <textarea name="productDetails" rows="4" placeholder="Enter product details" required></textarea>
                </div>

                <div class="form-group">
                    <label for="productCost">Cost (if applicable)</label>
                    <input type="number" name="productCost"  min="0" placeholder="Enter cost (0 for donation)" required>
                </div>

                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <select name="productCategory" required>
                        <option value="">Select a category</option>
                        <option value="electronics">Electronics</option>
                        <option value="furniture">Furniture</option>
                        <option value="clothes">Clothes</option>
                        <option value="education">Education</option>
                        <option value="health">Health & Hygiene</option>
                        <option value="food">Food</option>
                    </select>
                </div>

                <div class="upload-section">
                    <label for="productImage">Upload Image</label>
                    <input type="file" name="productImage" accept="image/*" required>
                </div>

                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
