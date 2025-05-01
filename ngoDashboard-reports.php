<?php
    session_start();
    include("ngo_loggedin_nav.php");
    include("./server/config.php");

    $email = $_SESSION['ngo-email'];
    $sql = "SELECT DISTINCT pr.product_name, pr.product_price, pu.purchase_date 
                    FROM purchase pu 
                    JOIN ngo n ON pu.ngo_id = n.ngo_id 
                    JOIN product pr ON pu.product_id = pr.product_id 
                    WHERE n.ngo_email = '$email'";
    $result = mysqli_query($dbcon, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report History</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {   
            padding: 2rem;
            color: #000;
        }

        h2 {
            margin-top: 4rem;
            text-align: center;
            margin-bottom: 2rem;
            color: #07145f;
            font-size: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .history-table {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
            padding: 1rem 2rem;
            overflow-x: auto;
        }

        .history-table h3 {
            color: #9B87F5;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f9f8f8;
            color: #07145f;
        }

        tr:hover {
            background-color: #f0f0ff;
        }

        .no-data {
            color: #ea384c;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Purchase History</h2>

        <div class="history-table">
            <h3> Purchase History</h3>
            <?php
                if ($result->num_rows > 0) {
                    echo "
                        <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Purchase Date</th>
                            <th>Price Paid</th>
                            
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$row['product_name']}</td>
                                <td>{$row['purchase_date']}</td>
                                <td>₹" . number_format($row['product_price'] * 1.10, 2) . "</td>
                                
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    $msg = "No Purchase Yet";
                }
            ?>

            <?php if (!empty($msg)) { ?>
                <h2 style="color: Green; margin-top: 10px; text-align: center; ">
                    <?php echo $msg; ?>
                </h2>
            <?php } ?>


            <!-- <table>
                <tr>
                    <th>Product Name</th>
                    <th>Purchase Date</th>
                    <th>Price Paid</th>
                </tr>
                <tr>
                    <td>Jackets</td>
                    <td>2025-02-20</td>
                    <td>₹350</td>
                </tr>
                <tr>
                    <td>Stationery Kit</td>
                    <td>2025-03-10</td>
                    <td>₹200</td>
                </tr>
            </table> -->
        </div>
    </div>
</body>
</html>
