<?php
session_start();
include("ngo_loggedin_nav.php");
include("./server/config.php");

if (!isset($_SESSION['ngo-email'])) {
    header("Location: ngo-login.php");
    exit();
}
$email = $_SESSION['ngo-email'];
$sql = "SELECT * FROM ngo WHERE ngo_email = '$email' ";
$result = mysqli_query($dbcon, $sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .settings-section {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .settings-section h3 {
            margin-bottom: 15px;
            font-size: 1.5em;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        .btn {
            background-color: #6a11cb;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #357ab8;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2><i class="fas fa-user-circle"></i>NGO Dashboard</h2>
            <ul class="sidebar-links">
                <li><a href="ngo-dashboard.php#personal-details"><i class="fas fa-user"></i>NGO Details</a></li>
                </li>
                <li><a href="ngoDashboard-collected-items.php"><i class="fas fa-bookmark"></i> Collected Items</a></li>
                <li><a href="ngo-cart.php"><i class="fas fa-bookmark"></i> Saved Items</a></li>
                <li><a href="ngo-dashboard.php#volunteer-status"><i class="fas fa-hands-helping"></i> Volunteer
                        Status</a>
                </li>
                <li><a href="ngo-settings.php"><i class="fas fa-cog"></i> Settings & Security</a></li>
                <li><a href="ngo-feedback.php"><i class="fas fa-star"></i> Feedback & Rating</a></li>
                <li><a href="ngo-logout.php">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h5>Settings</h5>
            </div>

            <!-- Profile Settings -->
            <div class="settings-section">
                <h3>Profile Settings</h3>
                <form>
                    <div class="form-group">
                        <label for="NGOname">NGOname</label>
                        <input type="text" id="NGOname" name="NGOname" placeholder="Enter your NGOname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn">Save Changes</button>
                </form>
            </div>

            <!-- Password Update -->
            <div class="settings-section">
                <h3>Update Password</h3>
                <form>
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword"
                            placeholder="Enter current password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword"
                            placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn">Update Password</button>
                </form>
            </div>

            <!-- General Settings -->
            <div class="settings-section">
                <h3>General Settings</h3>
                <form>
                    <div class="form-group">
                        <label for="siteName">Site Name</label>
                        <input type="text" id="siteName" name="siteName" placeholder="Enter site name" required>
                    </div>
                    <div class="form-group">
                        <label for="siteEmail">Site Email</label>
                        <input type="email" id="siteEmail" name="siteEmail" placeholder="Enter site email" required>
                    </div>
                    <button type="submit" class="btn">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>