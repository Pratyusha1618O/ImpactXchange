<?php
    session_start();
    include("admin_loggedin_nav.php");
    include("./server/config.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin-top: 4rem;
            font-family: 'Roboto', Arial, sans-serif;
            /* margin: 0; */
            padding: 0;
            background-color: #eef2f7;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            margin-top: 4rem;
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
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

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
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
            font-size: 1.8em;
        }

        .chart-container {
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .chart-container h3 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #2c3e50;
        }

        .chart-container canvas {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2><i class="fas fa-donate"></i> Admin Panel</h2>
            <ul>
                <li><a href="admin-dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-hand-holding-usd"></i> Donations</a></li>
                <li><a href="#"><i class="fas fa-bullhorn"></i> Campaigns</a></li>
                <li><a href="report.php"><i class="fas fa-chart-line"></i> Reports</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h5>Reports</h5>
            </div>

            <!-- Chart Section -->
            <div class="chart-container">
                <h3>Donation Distribution</h3>
                <canvas id="donationPieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Pie Chart Data
        const ctx = document.getElementById('donationPieChart').getContext('2d');
        const donationPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Electronics', 'Furniture', 'Clothes', 'Books', 'Health & Hygiene', 'Food'],
                datasets: [{
                    label: 'Donation Distribution',
                    data: [300, 150, 200, 100, 250, 400], // Example data
                    backgroundColor: [
                        '#3498db',
                        '#e74c3c',
                        '#f1c40f',
                        '#2ecc71',
                        '#9b59b6',
                        '#1abc9c'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#333'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>