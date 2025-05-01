<?php
    session_start();
    include("./server/config.php");
    include("user_logged_in_nav.php");

    $email = $_SESSION['email'];

    // $sql_purchase = "SELECT * FROM purchase p JOIN user u ON p.user_id = u.user_id WHERE u.user_email = '$email' ";
    $sql_purchase = "SELECT DISTINCT pr.product_name, pr.product_price, pu.purchase_date 
                    FROM purchase pu 
                    JOIN user u ON pu.user_id = u.user_id 
                    JOIN product pr ON pu.product_id = pr.product_id 
                    WHERE u.user_email = '$email'";
    $result1 = mysqli_query($dbcon, $sql_purchase);

    // $sql_donation = "SELECT * FROM product p JOIN user u ON p.user_id = u.user_id WHERE u.user_email = '$email' ";
    $sql_donation = "SELECT p.product_name, p.product_price, p.donation_date 
                 FROM product p 
                 JOIN user u ON p.user_id = u.user_id 
                 WHERE u.user_email = '$email'";
    $result2 = mysqli_query($dbcon, $sql_donation);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Donation & Purchase History</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin-top: 4rem;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            /* background: url("https://www.epnb.com/wp-content/uploads/2020/07/iStock-1152184147-1140x475.jpg");
            background-size: cover;
            background-repeat: no-repeat; */
        }

        h1 {
            text-align: center;
            padding: 2rem;
            color: #2c3e50;
        }



        .container {
            display: flex;
            justify-content: space-between;
            gap: 3rem;
            padding: 3rem;
            max-width: 90rem;
            margin: auto;
            flex-wrap: wrap;
        }

        .table-card {
            flex: 1;
            min-width: 480px;
            background-color: #ffffff7c;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .table-card h2 {
            text-align: center;
            color: #9B87F5;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #9B87F5;
            color: white;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;

        }

        tr:hover {
            background-color: #e6f7ff;
        }

        @media screen and (max-width: 1024px) {
            .history-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <h1 style="font-size: 40px;">Here's your Donation & Purchase History</h1>

    <div class="container">
        <div class="table-card purchase">
            <h2>Purchase History</h2>
            <?php
            if ($result1->num_rows > 0) {
                echo "
                    <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Purchase Date</th>
                        <th>Price</th>
                        
                    </tr>";
                while ($row1 = $result1->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row1['product_name']}</td>
                            <td>{$row1['purchase_date']}</td>
                            <td>{$row1['product_price']}</td>
                            
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
                    <th>Price</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Notebook Set</td>
                    <td>2025-03-15</td>
                    <td>₹120</td>
                    <td><a href=""><i class="fa-solid fa-up-right-from-square"></i></a></td>
                </tr>
                <tr>
                    <td>Used Backpack</td>
                    <td>2025-04-01</td>
                    <td>₹200</td>
                    <td><a href=""><i class="fa-solid fa-up-right-from-square"></i></a></td>

                </tr>

            </table> -->
        </div>

        <div class="table-card donation">
            <h2 style="color: #ffa666;">Donation History</h2>
            <?php
            if ($result2->num_rows > 0) {
                echo "
                    <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Purchase Date</th>
                        <th>Price</th>
                        
                    </tr>";
                while ($row2 = $result2->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>{$row2['product_name']}</td>
                            <td>{$row2['donation_date']}</td>
                            <td>{$row2['product_price']}</td>
                            
                        </tr>";
                }
                echo "</table>";
            }else {
                $msg2 = "No Donation Yet";
            }


            ?>

            <?php if (!empty($msg2)) { ?>
                <h2 style="color: green; margin-top: 10px; text-align: center; ">
                    <?php echo $msg; ?>
                </h2>
            <?php } ?>
        </div>


    </div>



</body>

</html>

<?php include("footer.php"); ?>