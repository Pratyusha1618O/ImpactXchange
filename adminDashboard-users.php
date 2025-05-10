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

$sql_user = "SELECT * FROM user ";
$result_user = mysqli_query($dbcon, $sql_user);

if (isset($_POST['delete'])) {
    $username = $_POST["username"];
    $useremail = $_POST["useremail"];

    $dlt_sql = "DELETE FROM user WHERE user_name = '$username' AND user_email = '$useremail' ";
    mysqli_query($dbcon, $dlt_sql);

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

        .dlt-btn {
            padding: 5px 8px;
            color: white;
            background-color: rgb(255, 146, 134);
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .dlt-btn:hover {
            background-color: #ff6756;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <h2><i class="fas fa-donate"></i> Welcome <?php echo "{$row['admin_name']}" ?></h2>
            <ul>
                <!-- <li><a href="#"><i class="fa-solid fa-user"></i>
                    <?php //echo "{$row['admin_name']}" ?>
                </a>
            </li> -->
                <li><a href="admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin-dashboard.php#donation"><i class="fas fa-hand-holding-usd"></i> Donations</a></li>
                <li><a href="admin-dashboard.php#campaign"><i class="fas fa-bullhorn"></i> Campaigns</a></li>
                <li><a href="adminDashboard-report.php"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="adminDashboard-users.php"><i class="fas fa-users"></i>Users</a></li>
                <li><a href="adminDashboard-ngos.php"><i class="fas fa-users"></i>NGOs</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="admin-logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </div>

        <div class="card recent-donations" id="donation">
            <h3>View All Users</h3>
            <?php
            if ($result_user->num_rows > 0) {
                echo "
                        <table>
                        <tr>
                            <th>Username</th>
                            <th>email</th>
                            <th>user_contact</th>
                            <th>user_address</th>
                            <th></th>
                            
                        </tr>";
                while ($row1 = $result_user->fetch_assoc()) {
                    echo <<<HTML
                        <tr>
                            <form method="POST">
                                <td>{$row1['user_name']}<input type="hidden" name="username" value="{$row1['user_name']}"></td>
                                <td>{$row1['user_email']}<input type="hidden" name="useremail" value="{$row1['user_email']}"></td>
                                <td>{$row1['user_contact']}</td>
                                <td>{$row1['user_address']}</td> 
                                <td><button class="dlt-btn" name="delete">Delete</button></td>
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

</body>

</html>