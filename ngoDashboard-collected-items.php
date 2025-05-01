<?php
session_start();
include("ngo_loggedin_nav.php");
include("./server/config.php");

$email = $_SESSION['ngo-email'];
$sql = "SELECT DISTINCT *
                    FROM purchase pu 
                    JOIN ngo n ON pu.ngo_id = n.ngo_id 
                    JOIN product pr ON pu.product_id = pr.product_id 
                    JOIN user u ON pr.user_id = u.user_id
                    WHERE n.ngo_email = '$email'";
$result = mysqli_query($dbcon, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Collected Items</title>
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
        <h2>Collected Items OverView</h2>

        <div class="history-table">
            <?php
                if ($result->num_rows > 0) {
                    echo "
                        <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th>Collected On</th>
                            <th>Donor</th>
                            
                        </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$row['product_name']}</td>
                                <td>{$row['product_type']}</td>
                                <td>{$row['purchase_date']}</td>
                                <td>{$row['user_name']}</td> 
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    $msg = "No Items Collected Yet";
                }
            ?>

            <?php if (!empty($msg)) { ?>
                <h2 style="color: Green; margin-top: 10px; text-align: center; ">
                    <?php echo $msg; ?>
                </h2>
            <?php } ?>

        </div>
    </div>
</body>

</html>
