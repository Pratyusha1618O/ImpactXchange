<?php
session_start();
include("admin_loggedin_nav.php");
include("./server/config.php");

if (!isset($_SESSION["admin-email"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['admin-email'];
$sql = "SELECT * FROM admin WHERE admin_email = '$email' ";
$result = mysqli_query($dbcon, $sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
}
$sql_product = "SELECT 
                    *, 
                    TIME(donation_date) AS donation_time 
                FROM product 
                JOIN user ON product.user_id = user.user_id WHERE admin_status = 'pending'
                ORDER BY donation_date DESC;";
$result_product = mysqli_query($dbcon, $sql_product);

if (isset($_POST['delete'])) {
    $userid = $_POST["userid"];
    $pid = $_POST["pid"];

    $dlt_sql = "DELETE FROM product WHERE user_id = '$userid' AND product_id = '$pid' ";
    mysqli_query($dbcon, $dlt_sql);

    echo "<script>window.location.href = window.location.href;</script>";
    exit();
}

if (isset($_POST['approve'])) {
    $userid = $_POST["userid"];
    $pid = $_POST["pid"];
    $approve_sql = "UPDATE product SET admin_status = 'approved' WHERE user_id = '$userid' AND product_id  = '$pid' ";
    mysqli_query($dbcon, $approve_sql);

    echo "<script>window.location.href = window.location.href;</script>";
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f7;
            color: #333;
            margin-top: 4rem;
        }


        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            /* margin-top: 3rem; */
            min-height: 100vh;
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            /* position: fixed; */
            top: 20px;
            bottom: 0;
            overflow-y: auto;
            border-right: 1px solid #ddd;
            /* Add a border to separate the sidebar */
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ecf0f1;
            font-weight: bold;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: #3498db;
        }

        .card p {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }

        .recent-donations {
            margin-top: 30px;
            /* Add spacing above the recent donations section */
        }

        .recent-donations h3 {
            margin-bottom: 10px;
            font-size: 1.5em;
            color: #2c3e50;
        }

        .recent-donations table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .recent-donations table th,
        .recent-donations table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .recent-donations table th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
        }

        .recent-donations table tr:hover {
            background-color: #f2f2f2;
        }

        .chart-container {
            margin-top: 30px;
            /* Add spacing above the chart section */
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .chart-container h3 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #2c3e50;
        }

        .card:target {
            /* border: 2px solid #f9f8f8; */
            background: ;
            /* box-shadow: 0 0 15px   #fff674; */
            background: linear-gradient(-45deg, hsl(65, 100.00%, 57.60%), #f9f8f8);
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .btn {
            padding: 5px 8px;
            color: white;
            background-color: #ff9286;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn:hover {
            background-color: #ff6756;
        }
        .approve:hover {
            background-color:rgb(30, 65, 173);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2><i class="fas fa-donate"></i> Welcome <?php echo "{$row['admin_name']}" ?></h2>
            <ul>
                <li><a href="admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin-dashboard.php#donation"><i class="fas fa-hand-holding-usd"></i> Donations</a></li>
                <li><a href="#"><i class="fa-regular fa-clock"></i> Pending Approvals</a></li>
                <li><a href="admin-dashboard.php#campaign"><i class="fas fa-bullhorn"></i> Campaigns</a></li>
                <li><a href="adminDashboard-report.php"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="adminDashboard-users.php"><i class="fas fa-users"></i>Users</a></li>
                <li><a href="adminDashboard-ngos.php"><i class="fas fa-users"></i>NGOs</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="admin-logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </div>

        <div class="card recent-donations" id="donation">
            <h3>View Donations</h3>
            <?php
            if ($result_product->num_rows > 0) {
                echo "
                        <table>
                        <tr>
                            <th>Donor</th>
                            <th>Product</th>
                            <th>Product Details</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th></th> 
                        </tr>";
                while ($row1 = $result_product->fetch_assoc()) {
                    echo <<<HTML
                            <tr>
                                <form method="POST">
                                    <td>{$row1['user_name']}<input type="hidden" name="userid" value="{$row1['user_id']}"></td>
                                    <td>{$row1['product_name']}<input type="hidden" name="pid" value="{$row1['product_id']}"></td>
                                    <td>{$row1['product_details']}<input type="hidden" name="pid" value="{$row1['product_id']}"></td>
                                    <td>{$row1['donation_date']}</td>
                                    <td>{$row1['product_price']}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="showImageModal('{$row1['product_img'] }')" style="margin-left:10px; text-decoration:none; color: black"><i class="fa-solid fa-file-image"></i></a>
                                    </td>
                                    <td>
                                        <button class="btn approve" name="approve" style="background-color:rgb(134, 152, 255);">Approve</button>
                                        <button class="btn" name="delete">Delete</button>
                                    </td>
                                </form> 
                            </tr>
                        HTML;
                }
                echo "</table>";
            } else {
                $msg = "No Records";
            }
            ?>

            <?php if (!empty($msg)) { ?>
                <h2 style="color: Green; margin-top: 10px; text-align: center; ">
                    <?php echo $msg; ?>
                </h2>
            <?php } ?>
            
        </div>
    </div>

    <!-- Image Preview Modal -->
<div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.7); justify-content:center; align-items:center; z-index:1000;">
    
    <div style="position:relative; background:#fff; padding:15px; border-radius:8px;">
        <img id="modalImage" src="" alt="Product Image" style="max-width:90vw; max-height:80vh; display:block;">
        <span onclick="closeImageModal()" style="position:absolute; top:5px; right:10px; cursor:pointer; font-size:24px; color:red;">&times;</span>
    </div>
</div>

<script>
    
        function showImageModal(imageName) {
            document.getElementById('modalImage').src = './product_images/' + imageName;
            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
</script>

</body>

</html>