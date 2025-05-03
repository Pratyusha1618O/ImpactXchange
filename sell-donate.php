<?php
session_start();
include("./server/config.php");

if (isset($_SESSION['email'])) {
    include("user_logged_in_nav.php");
} else if (isset($_SESSION["ngo-email"])) {
    include("ngo_loggedin_nav.php");
} else if (isset($_SESSION["admin-email"])) {
    include("admin_loggedin_nav.php");
} else {
    include("header.php");
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
        <!-- Left Section -->
        <div class="left-section">
            <h2>Welcome!</h2>
            <p>Want to donate or sell a product?</p>
            <button onclick="window.location.href='viewProduct.html'">View Products</button>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h3>Sell/Donate Product</h3>
            <form id="productForm">
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" name="productName" placeholder="Enter product name" required>
                </div>
                <div class="form-group">
                    <label for="productDetails">Product Details</label>
                    <textarea id="productDetails" name="productDetails" rows="4" placeholder="Enter product details"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="productCost">Cost (if applicable)</label>
                    <input type="number" id="productCost" name="productCost" placeholder="Enter cost (0 for donation)"
                        required>
                </div>
                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <select id="productCategory" name="productCategory" required>
                        <option value="">Select a category</option>
                        <option value="electronics">Electronics</option>
                        <option value="furniture">Furniture</option>
                        <option value="clothes">Clothes</option>
                        <option value="books">Books</option>
                        <option value="health">Health & Hygiene</option>
                        <option value="food">Food</option>
                    </select>
                </div>
                <div class="upload-section">
                    <label for="productImage">Upload Product Image</label>
                    <input type="file" id="productImage" name="productImage" accept="image/*">
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const productForm = document.getElementById('productForm');

        productForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const productName = document.getElementById('productName').value;
            const productDetails = document.getElementById('productDetails').value;
            const productCost = document.getElementById('productCost').value;
            const productCategory = document.getElementById('productCategory').value;
            const productImage = document.getElementById('productImage').files[0];

            alert(`Product Submitted!\n\nName: ${productName}\nDetails: ${productDetails}\nCost: ${productCost}\nCategory: ${productCategory}\nImage: ${productImage ? productImage.name : 'No image uploaded'}`);
            
            // Reset the form after submission
            productForm.reset();
        });
    </script>
</body>

</html>