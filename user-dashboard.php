<?php
 session_start();
include("user_logged_in_nav.php");
include("./server/config.php");

if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE user_email = '$email' ";
$result = mysqli_query($dbcon, $sql);

if($result->num_rows > 0)
{
    $row = mysqli_fetch_assoc($result);
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
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
            /* box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); */
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

        .card:target {
            border: 1px solid #3498db;
            box-shadow: 0 0 10px  #3498db;
            /* background: linear-gradient(-45deg ,rgb(233, 228, 255),rgb(255, 255, 255)); */
        }


        .btn {
            background-color:rgb(99, 182, 255);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            
        }

        .btn a{
            text-decoration: none;
            color: white;
        }

        .btn:hover {
            background: rgb(128, 53, 212);
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <ul class="sidebar-links">
                <li><a href="#personal-details"><i class="fas fa-user-circle"></i> 
                        <?php echo "{$row['user_name']}"?>
                    </a>
                </li>
                <li><a href="#donation-history"><i class="fas fa-hand-holding-usd"></i> Donation & Purchase History</a>
                </li>
                <li><a href="#saved-items"><i class="fas fa-bookmark"></i> Saved Items</a></li>
                <li><a href="#volunteer-status"><i class="fas fa-hands-helping"></i> Volunteer Status</a></li>
                <li><a href="#ngos"><i class="fa-solid fa-users-viewfinder"></i> Connect wit NGOs</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> Settings & Security</a></li>
                <li><a href="#feedback"><i class="fas fa-star"></i> Feedback & Rating</a></li>
                <li><a href="user-logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="card" id="personal-details">
                <h3>Personal Details</h3>
                <p><strong>Name:</strong>
                    <?php
                        echo "{$row['user_name']}";
                    ?>
                </p>
                <p><strong>Contact Info:</strong>
                    <?php
                        echo "{$row['user_email']}";
                    ?>
                </p>
                <p><strong>Address:</strong> 
                    <?php
                        echo "{$row['user_address']}";
                    ?>
                </p>
            </div>

            <div class="card" id="donation-history">
                <h3>Donation & Purchase History</h3>
                <p>Track your past donations and purchases.</p>
                <button class="btn"><a href="userDashboard-donation-history.php">View History</a> </button>
            </div>

            <div class="card" id="saved-items">
                <h3>Saved Items</h3>
                <p>View your wishlist or bookmarked products.</p>
                <button class="btn"><a href="userDashboard-saved-items.php">View Saved Items</a></button>
            </div>

            <div class="card" id="volunteer-status">
                <h3>Volunteer Status</h3>
                <p>Track your disaster relief or NGO participation.</p>
                <button class="btn"><a href="userDashboard-volunteer-status.php">View Status</a></button>
            </div>

            <div class="card" id="ngos">
                <h3>Connect with NGOs</h3>
                <p>View NGOs connected with us and contact them in need</p>
                <button class="btn"><a href="userDashboard-ngo.php">View Status</a></button>
            </div>

            <div class="card" id="settings">
                <h3>Settings & Security</h3>
                <p>Change your password, account preferences, or delete your account.</p>
                <button class="btn"><a href="user-settings.php">Go to Settings</a></button>
            </div>

            <div class="card" id="feedback">
                <h3>Feedback & Rating</h3>
                <p>Share your feedback or rate our platform.</p>
                <button class="btn"><a href="feedback.php">Submit Feedback</a></button>
            </div>



        </main>
    </div>
</body>

</html>