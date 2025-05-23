<?php
session_start();
include("user_logged_in_nav.php");
include("./server/config.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE user_email = '$email' ";
$result = mysqli_query($dbcon, $sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
}

$sql_ngo = "SELECT * FROM ngo ";
$result_ngo = mysqli_query($dbcon, $sql_ngo);

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

        .main-content {
            flex: 1;
            margin-left: 280px;
            /* Add space to account for the sidebar width + gap */
            padding: 20px;
            /* width: 50vw; */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h5 {
            margin: 0;
            font-size: 1.5em;
        }

        .header .notification {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .header .notification i {
            margin-right: 10px;
        }

        .header .notification:hover {
            background-color: #2980b9;
        }

        .summary {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            /* Add spacing below the summary section */
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
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <ul class="sidebar-links">
                <li><a href="#personal-details"><i class="fas fa-user-circle"></i>
                        <?php echo "{$row['user_name']}" ?>
                    </a>
                </li>
                <li><a href="userDashboard-donation-history.php"><i class="fas fa-hand-holding-usd"></i> Donation &
                        Purchase History</a>
                </li>
                <li><a href="userDashboard-saved-items.php"><i class="fas fa-bookmark"></i> Saved Items</a></li>
                <li><a href="useDashboard-volunteer-status.php"><i class="fas fa-hands-helping"></i> Volunteer
                        Status</a></li>
                <li><a href="#"><i class="fa-solid fa-users-viewfinder"></i> Connect wit NGOs</a></li>
                <li><a href="user-settings.php"><i class="fas fa-cog"></i> Settings & Security</a></li>
                <li><a href="feedback.php"><i class="fas fa-star"></i> Feedback & Rating</a></li>
                <li><a href="user-logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </aside>

        <div class="card recent-donations" id="donation">
            <h3>NGOs Connected with us</h3>
            <?php
            if ($result_ngo->num_rows > 0) {
                echo "
                        <table>
                        <tr>
                            <th>NGO name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th></th>
                        </tr>";
                while ($row1 = $result_ngo->fetch_assoc()) {
                    echo <<<HTML
                        <tr> 
                            <td>{$row1['ngo_name']}<input type="hidden" name="ngoname" value="{$row1['ngo_name']}"></td>
                            <td>{$row1['ngo_email']}<input type="hidden" name="ngoemail" value="{$row1['ngo_email']}"></td>
                            <td>{$row1['ngo_contact']}</td>
                            <td>{$row1['ngo_address']}</td>  
                            <td><a href="#"><i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                                     
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