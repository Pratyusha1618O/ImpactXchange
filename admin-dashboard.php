<?php
    session_start();
    include("header.php");
    include("./server/config.php");

    if(!isset($_SESSION["admin-email"])){
        header("Location: login.php");
        exit();
    }
    $email = $_SESSION['admin-email'];
    $sql = "SELECT * FROM admin WHERE admin_email = '$email' ";
    $result = mysqli_query($dbcon, $sql);

    if($result->num_rows > 0)
    {
        $row = mysqli_fetch_assoc($result);
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
        }
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top:20px;
            bottom: 0;
            overflow-y: auto;
            border-right: 1px solid #ddd; /* Add a border to separate the sidebar */
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
            margin-left: 280px; /* Add space to account for the sidebar width + gap */
            padding: 20px;
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
            margin-bottom: 30px; /* Add spacing below the summary section */
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
            margin-top: 30px; /* Add spacing above the recent donations section */
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
        .recent-donations table th, .recent-donations table td {
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
            margin-top: 30px; /* Add spacing above the chart section */
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><i class="fas fa-donate"></i> Welcome Admin</h2>
        <ul>
            <li><a href="#"><i class="fa-solid fa-user"></i>
                    <?php echo "{$row['admin_name']}"?>
                </a>
            </li>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-hand-holding-usd"></i> Donations</a></li>
            <li><a href="#"><i class="fas fa-bullhorn"></i> Campaigns</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="admin-logout.php"><i class="fa-solid fa-power-off"></i></i> Log out</a></li>
        </ul>
    </div>
        <div class="main-content">
            <div class="header">
                <h5>Dashboard</h5>
                <button class="notification">
                    <i class="fas fa-bell"></i> Notifications
                </button>
            </div>
            <div class="summary">
                <div class="card">
                    <h3>Total Donations</h3>
                    <p>Rs: 300</p>
                </div>
                <div class="card">
                    <h3>Active Campaigns</h3>
                    <p>8</p>
                </div>
                <div class="card">
                    <h3>Donors</h3>
                    <p>10</p>
                </div>
            </div>
            <div class="chart-container">
                <h3>Donation Trends</h3>
                <canvas id="donationChart"></canvas>
            </div>
            <div class="card recent-donations">
                <h3>Recent Donations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Donor</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Rs. 100</td>
                            <td>2023-10-01</td>
                            <td><i class="fas fa-check-circle" style="color: green;"></i> Completed</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Rs. 50</td>
                            <td>2023-09-30</td>
                            <td><i class="fas fa-clock" style="color: orange;"></i> Pending</td>
                        </tr>
                        <tr>
                            <td>Michael Brown</td>
                            <td>Rs. 200</td>
                            <td>2023-09-29</td>
                            <td><i class="fas fa-check-circle" style="color: green;"></i> Completed</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('donationChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April'],
                datasets: [{
                    label: 'Donations',
                    data: [1200, 1900, 3000, 5000],
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>