<?php
session_start();
include("./server/config.php");


$user_id = "NULL";
$ngo_id = "NULL";
if (isset($_SESSION['email'])) {
    include("user_logged_in_nav.php");
    $user_email = $_SESSION['email'];
    $sql = "SELECT * FROM user WHERE user_email = '$user_email' ";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

} else if (isset($_SESSION["ngo-email"])) {
    include("ngo_loggedin_nav.php");
    $ngo_email = $_SESSION['ngo-email'];
    $sql = "SELECT * FROM ngo WHERE ngo_email = '$ngo_email' ";
    $result = mysqli_query($dbcon, $sql);
    $row = mysqli_fetch_assoc($result);
    $ngo_id = $row['ngo_id'];

} else if (isset($_SESSION["admin-email"])) {
    include("admin_loggedin_nav.php");
    $email = $_SESSION['admin-email'];
} else {
    include("header.php");
}


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
    $result = mysqli_query($dbcon, $sql);
    $product = mysqli_fetch_assoc($result);

    // Display the product details below
} else {
    echo "Product not found.";
}


if (isset($_POST["submit"])) {
    $today_date = date("Y-m-d");
    $product_id = $_POST['product_id'];

    // echo "DEBUG VALUES:<br>";
    // echo "User ID: " . $user_id . "<br>";
    // echo "NGO ID: " . $ngo_id . "<br>";
    // echo "Product ID: " . $product_id . "<br>";
    // echo "Date: " . $today_date . "<br>";

    $sql = "INSERT IGNORE INTO purchase (user_id, product_id, purchase_date, ngo_id) VALUES (
        " . ($user_id === "NULL" ? "NULL" : "'$user_id'") . ",
        '$product_id',
        '$today_date',
        " . ($ngo_id === "NULL" ? "NULL" : "'$ngo_id'") . "
    )";

    echo "<br><b>Final SQL:</b> $sql<br>";

    if (mysqli_query($dbcon, $sql)) {
        echo "<script>alert('Purchase successful!');</script>";
        // After purchase insert succeeds:
        $markSold = "UPDATE product SET status='sold' WHERE product_id = '$product_id'";
        mysqli_query($dbcon, $markSold);
        // then remove from cart only
        mysqli_query($dbcon, "DELETE FROM cart WHERE product_id = '$product_id'");
    } else {
        echo "Error: " . mysqli_error($dbcon);
    }



}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Buy Now - Product Name</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: gray;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .buy-now-container {
            max-width: 500px;
            margin: 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.13);
            padding: 36px 30px 28px 30px;
            animation: fadeIn 0.7s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .product-info {
            text-align: center;
            margin-bottom: 28px;
        }

        .product-info img {
            width: 170px;
            border-radius: 12px;
            margin-bottom: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.09);
        }

        .product-info h2 {
            margin: 10px 0 5px 0;
            font-size: 1.6rem;
            color: #f97316;
            font-weight: 600;
        }

        .product-info p {
            margin: 4px 0;
            color: #444;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            font-weight: 500;
            margin-bottom: 4px;
            color: #333;
        }

        input,
        textarea,
        select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 1rem;
            background: #fafafa;
            transition: border 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border: 1.5px solid #f97316;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 60px;
        }

        .payment-modes {
            display: flex;
            gap: 18px;
        }

        .payment-modes label {
            font-weight: 400;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        button[type="submit"] {
            background: linear-gradient(90deg, #f97316 60%, #ff2d6c 100%);
            color: #fff;
            border: none;
            padding: 14px 0;
            border-radius: 7px;
            font-size: 1.15rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(249, 115, 22, 0.08);
            transition: background 0.2s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background: linear-gradient(90deg, #ff2d6c 60%, #f97316 100%);
            transform: translateY(-2px) scale(1.03);
        }

        @media (max-width: 600px) {
            .buy-now-container {
                padding: 18px 6vw;
            }

            .product-info img {
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="buy-now-container">

        <div class="product-info">
            <img src="./product_images/<?= $product['product_img'] ?>" alt="Product Image">
            <h2><?= $product['product_name'] ?></h2>
            <p><strong>Price:</strong><?= $product['product_price'] ?></p>
            <p><strong>Category:</strong> <?= $product['product_type'] ?></p>
            <p><?= $product['product_details'] ?></p>

        </div>
        <form method="POST">
            <!-- carry the product_id into POST -->
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">

            <label for="address">Delivery Address</label>
            <textarea name="address" id="address" placeholder="Enter your full delivery address" required></textarea>

            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="e.g. 9876543210" pattern="[0-9]{10}" maxlength="10"
                required>

            <label>Payment Mode</label>
            <div class="payment-modes">
                <label><input type="radio" name="payment_mode" value="COD" checked> Cash on Delivery</label>
                <label><input type="radio" name="payment_mode" value="UPI"> UPI</label>
                <label><input type="radio" name="payment_mode" value="Card"> Card</label>
            </div>

            <button type="submit" name="submit">Confirm Purchase</button>
        </form>
    </div>
</body>

</html>
<?php include("footer.php");
?>