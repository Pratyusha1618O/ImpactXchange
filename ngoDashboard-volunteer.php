<?php
session_start();
include("ngo_loggedin_nav.php");
include("./server/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NGO Volunteer Status</title>
    <style>
        body {
            color: #fff;
        }

        .volunteer-container {}

        header {
            margin-top: 4rem;
            text-align: center;
            padding: 40px 20px;
            color: #fff;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #07145f;
        }

        header p {
            font-size: 20px;
            color: #07145f;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: rgb(255, 255, 255);
            color: #000;
            border-radius: 12px;
            box-shadow: 0 10px 20px #acacac;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            justify-content: space-between;
            padding: 2rem 3rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px #c9c9c9;
        }

        .card h3 {
            margin-top: 0;
            color: #07145f;
        }

        .status {
            font-weight: bold;
            color: #F97316;
            font-size: 18px;
        }

        .date {
            font-size: 0.9rem;
            color: #4c4b4b;
            margin-top: 0.5rem;
            font-size: 15px;
        }

        .volunteer-name {
            margin-top: 10px;
            font-size: 1rem;
            color: #9B87F5;
        }
    </style>
</head>

<body>
    <div class="volunteer-container">
        <header>
            <h1>Volunteer Status</h1>
            <p>Track all volunteers registered for your NGO's programs and their current status.</p>
        </header>

        <section class="container">
            <div class="card">
                <div class="card-left">
                    <h3>Flood Relief Camp</h3>
                    <p class="volunteer-name">Volunteer: Ankita Das</p>
                </div>
                <div class="card-right">
                    <p class="status">Status: Completed</p>
                    <p class="date">Date: March 15, 2025</p>
                </div>
            </div>

            <div class="card">
                <div class="card-left">
                    <h3>Clothes Donation Drive</h3>
                    <p class="volunteer-name">Volunteer: Sourav Paul</p>
                </div>
                <div class="card-right">
                    <p class="status">Status: Ongoing</p>
                    <p class="date">Date: April 10, 2025</p>
                </div>
            </div>

            <div class="card">
                <div class="card-left">
                    <h3>Food Distribution</h3>
                    <p class="volunteer-name">Volunteer: Priya Ghosh</p>
                </div>
                <div class="card-right">
                    <p class="status">Status: Upcoming</p>
                    <p class="date">Scheduled: May 5, 2025</p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>

<?php
include("footer.php");
?>