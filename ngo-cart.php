<?php
session_start();
include("./server/config.php");
include("ngo_loggedin_nav.php");


$email = $_SESSION['ngo-email'];

// SQL to fetch saved products joined with product details
$sql = "SELECT DISTINCT *
        FROM ngo_cart
        JOIN product ON ngo_cart.product_id = product.product_id
        JOIN ngo ON ngo.ngo_id = ngo_cart.ngo_id 
        WHERE ngo.ngo_email = '$email'";


$result = mysqli_query($dbcon, $sql);



if (isset($_POST['delete'])) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $product_id = $row['product_id'];
        $ngo_id = $row['ngo_id'];

        $dlt_sql = "DELETE FROM ngo_cart WHERE product_id = '$product_id' AND ngo_id = '$ngo_id' ";
        mysqli_query($dbcon, $dlt_sql);

    }


}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NGO Saved Items</title>
    <style>
        body {
            background: url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png');
            background-color: #f9f8f8;
            color: #000000;
        }

        header {
            margin-top: 4rem;
            background-color: rgb(63, 6, 103);
            padding: 2rem 2rem;
            text-align: center;
            color: #ffffff;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: #07145f;
        }

        .saved-items-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .item-image img {
            width: 200px;
        }

        .item-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px #acacac;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 0.5rem;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px #c9c9c9;
            box-shadow: 0 0 5px #b1bdff;
            transition: 0.3s;
        }

        .item-details {
            padding: 15px;
        }

        .item-details h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #07145f;
        }

        .item-details p {
            margin: 8px 0;
            font-size: 0.95rem;
            color: #4c4b4b;
        }

        .item-price {
            color: #F97316;
            font-weight: bold;
        }

        .view-btn {
            /* margin-top: 10px; */
            padding: 8px 16px;
            background-color: #07145f;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.2s ease;
            /* display: inline-block; */
        }

        .view-btn:hover {
            background-color: #1e2a91;
        }

        .btns{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }

        .dlt-btn {
            padding: 8px 16px;
            color: white;
            background-color: rgb(212, 48, 78);
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .dlt-btn:hover {
            background-color:rgb(176, 42, 37);
        }
    </style>
</head>

<body>

    <header>
        <h1>Your Saved Items</h1>
    </header>

    <div class="container">
        <p class="section-title">Here are the items you've saved for later. Revisit them anytime!</p>

        <div class="saved-items-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="item-card">
                        <div class="item-image">
                            <img src="product_images/<?php echo $row['product_img']; ?>?>" alt="Product Image" width="300">
                        </div>
                        <div class="item-details">
                            <p style="text-align: center; color:  #37a8fe;">Status: <?php echo htmlspecialchars($row['status']); ?></p>
                            <h3>Product: <?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <p>Category: <?php echo htmlspecialchars($row['product_type']); ?></p>
                            <p class="item-price">
                                <?php
                                echo $row['product_price'] == 0 ? 'Free' : '₹' . htmlspecialchars($row['product_price']);
                                ?>
                            </p>
                        </div>

                        <div style="text-align: center;" class="btns">
                            <a href="view-product.php#<?php echo $row['product_id']; ?>" class="view-btn">View</a>
                            <form method="POST">
                                <button class="dlt-btn" name="delete">Remove</button>
                            </form>
                        </div>

                    </div>
                    <?php
                }
            } else {
                $msg = "No items saved yet.";
            }
            ?>
            <!-- <div class="item-card">
                <div class="item-image">
                    <img src="https://5.imimg.com/data5/SELLER/Default/2024/3/400822043/IO/KP/QM/59907886/electronics-fundamentals-and-applications-15th-ed-book-by-d-chattopadhyay-500x500.jpeg"
                        alt="Product Image">
                </div>
                <div class="item-details">
                    <h3>Product: Book</h3>
                    <p>Category: Education</p>
                    <p class="item-price">₹250</p>
                </div>
            </div>

            <div class="item-card">
                <div class="item-image">
                    <img src="" alt="Product Image">
                </div>
                <div class="item-details">
                    <h3>Product: Old Clothes</h3>
                    <p>Category: Clothes</p>
                    <p class="item-price">Free</p>
                </div>
            </div>

            <div class="item-card">
                <div class="item-image">
                    <img src="https://via.placeholder.com/300x180" alt="Product Image">
                </div>
                <div class="item-details">
                    <h3>Product: Used School Books</h3>
                    <p>Category: Education</p>
                    <p class="item-price">₹50</p>
                </div>
            </div> -->


        </div>

        <?php if (!empty($msg)) { ?>
            <h2 style="color: #29cf2f; margin-top: 10px; text-align: center;">
                <?php echo $msg; ?>
            </h2>
            <!-- <button>View Now</button> -->
        <?php } ?>
    </div>

</body>

</html>

<?php // include("footer.php"); ?>