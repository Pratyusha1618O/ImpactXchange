<?php
    session_start();
    include("ngo_loggedin_nav.php");
    include("./server/config.php");

    if(!isset($_SESSION["ngo-email"])){
        header("Location: ngo-login.php");
        exit();
    }
    
    $email = $_SESSION['ngo-email'];
    $sql = "SELECT * FROM ngo WHERE ngo_email = '$email' ";
    $result = mysqli_query($dbcon, $sql);

    $row = null;
    if($result && mysqli_num_rows($result) > 0 )
    {
        $row = mysqli_fetch_assoc($result);
    }

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <title>NGO Dashboard</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fb;
            color: #333;
        }

        .dashboard-container {
            margin-top: 3.5rem;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
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
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 20px;
            color: #ecf0f1;
        }

        .sidebar-links {
            list-style: none;
            padding: 0;
        }

        .sidebar-links li {
            margin: 15px 0;
        }

        .sidebar-links li a {
            text-decoration: none;
            color: #ecf0f1;
            font-weight: bold;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar-links li a:hover {
            background-color: #34495e;
        }

        .sidebar-links li a i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        /* Main Content Styling */
        .main-content {
            flex: 1;
            margin-left: 270px;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card h3 {
            font-size: 1.5em;
            color: #3498db;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1em;
            color: #555;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn a{
            text-decoration: none;
            color: white;
        }

        .card:target {
            /* border: 2px solid #f9f8f8; */
            background: ;
            /* box-shadow: 0 0 15px   #fff674; */
            background: linear-gradient(-45deg , #fff237, #f9f8f8);
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2><i class="fas fa-user-circle"></i>NGO Dashboard</h2>
            <ul class="sidebar-links">
                <li><a href="#personal-details"><i class="fas fa-user"></i>NGO Details</a></li>
                <!-- <li><a href="#donation-history"><i class="fa-solid fa-pen-to-square"></i> Reports</a> -->
                </li>
                <li><a href="#saved-items"><i class="fas fa-bookmark"></i> Collected Items</a></li>
                <li><a href="#volunteer-status"><i class="fas fa-hands-helping"></i> Volunteer Status</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> Settings & Security</a></li>
                <li><a href="#feedback"><i class="fas fa-star"></i> Feedback & Rating</a></li>
                <li><a href="ngo-logout.php">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="card" id="personal-details">
                <h3>NGO Details</h3>
                <p><strong>Name:</strong>
                    <?php
                        echo "{$row['ngo_name']}";
                    ?>
                </p>
                <p><strong>Contact Info:</strong>
                    <?php
                        echo "{$row['ngo_email']}";
                    ?>
                </p>
                <p><strong>Address:</strong> 
                    <?php
                        echo "{$row['ngo_address']}";
                    ?>
                </p>
            </div>

            <!-- <div class="card" id="donation-history">
                <h3>Reports</h3>
                <p>Track your past purchases.</p>
                <button class="btn"><a href="ngoDashboard-reports.php">View History</a></button>
            </div> -->

            <div class="card" id="saved-items">
                <h3>Collected Items</h3>
                <p>View your collected items</p>
                <button class="btn"><a href="ngoDashboard-collected-items.php">View collected Items</a></button>
            </div>

            <div class="card" id="volunteer-status">
                <h3>Volunteer Status</h3>
                <p>Track your disaster relief or NGO participation.</p>
                <button class="btn"><a href="ngoDashboard-volunteer.php">View Status</a></button>
            </div>

            <div class="card" id="settings">
                <h3>Settings & Security</h3>
                <p>Change your password, account preferences, or delete your account.</p>
                <button class="btn">Go to Settings</button>
            </div>

            <div class="card" id="feedback">
                <h3>Feedback & Rating</h3>
                <p>Share your feedback or rate our platform.</p>
                <button class="btn">Submit Feedback</button>
            </div>



        </main>
    </div>
</body>

</html>

