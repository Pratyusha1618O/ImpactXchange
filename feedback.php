<?php
session_start();
include("./server/config.php");
include("user_logged_in_nav.php");

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["submit"])) {
        $feedback = $_POST["feedback"];

        $userID_sql = "SELECT user_id FROM user WHERE user_email = '$email'";
        $userResult = mysqli_query($dbcon, $userID_sql);
        $userRow = mysqli_fetch_assoc($userResult);
        $user_id = $userRow['user_id'];

        $sql = "INSERT INTO feedback(user_id, feedback_text) VALUES ('$user_id', '$feedback')";
        $query = mysqli_query($dbcon, $sql);

        if ($query) {
            $msg = "✅ You feedback has been sent. Thank You User ✨";
        } else {
            echo "error";
        }

    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ImpactXchange</title>
    <link rel="stylesheet" href="./style_index.css">
    <link rel="stylesheet" href="./responsive.css">
    <script src="https://kit.fontawesome.com/63ce28b4a6.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .contact-section {
            padding: 50px 20px;
            text-align: center;
        }

        .contact-section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .contact-section p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            text-align: left;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }

        .contact-form label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .contact-form button {
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 2rem;
        }

        .contact-form button:hover {
            background: #0056b3;
        }

        .contact-info {
            margin-top: 30px;
            text-align: center;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 1rem;
            color: #555;
        }

        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
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

        // star
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .rating-container {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .stars {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .star {
            font-size: 2rem;
            color: lightgray;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star:hover,
        .star.hovered,
        .star.selected {
            color: gold;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
    <h2>Dashboard</h2>
        <ul class="sidebar-links">
            <li><a href="user-dashboard.php"><i class="fas fa-user-circle"></i>
                    <?php echo "{$row['user_name']}" ?>
                </a>
            </li>
            <li><a href="#donation-history"><i class="fas fa-hand-holding-usd"></i> Donation & Purchase History</a>
            </li>
            <li><a href="#saved-items"><i class="fas fa-bookmark"></i> Saved Items</a></li>
            <li><a href="#volunteer-status"><i class="fas fa-hands-helping"></i> Volunteer Status</a></li>
            <li><a href="userDashboard-ngo.php"><i class="fa-solid fa-users-viewfinder"></i> Connect wit NGOs</a></li>
            <li><a href="user-settings.php"><i class="fas fa-cog"></i> Settings & Security</a></li>
            <li><a href="feedback.php"><i class="fas fa-star"></i> Feedback & Rating</a></li>
            <li><a href="user-logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
        </ul>
    </aside>
    <div class="contact-section">
        <br>
        <br>
        <br>
        <h1>Send Your Feedback</h1>

        <!-- Contact Form -->
        <form class="contact-form" method="POST">
            <label for="feedback">Your FeedBack</label>
            <textarea id="feedback" name="feedback" rows="5" placeholder="Enter your feedback" required></textarea>

            <div class="rating-container">
                <h2>How much you will rate us!!</h2>
                <div class="stars" id="stars">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
                <p id="rating-text"></p>
            </div>

            <button type="submit" name="submit">Send FeedBack</button>

            <?php if (!empty($msg)) { ?>
                <p style="color: green; margin-top: 10px; text-align: center;">
                    <?php echo $msg; ?>
                </p>
            <?php } ?>
        </form>
    </div>


</body>

<script>
    const stars = document.querySelectorAll('.star');
    const ratingText = document.getElementById('rating-text');
    let selectedRating = 0;

    stars.forEach(star => {
        // Hover effect
        star.addEventListener('mouseover', () => {
            const value = parseInt(star.getAttribute('data-value'));
            updateStars(value);
        });

        // Remove hover
        star.addEventListener('mouseout', () => {
            updateStars(selectedRating);
        });

        // Click to rate
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.getAttribute('data-value'));
            updateStars(selectedRating);
            ratingText.textContent = `You rated us ${selectedRating} star${selectedRating > 1 ? 's' : ''}.`;
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

</script>

</html>