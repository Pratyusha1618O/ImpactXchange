<?php
 include("header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - ImpactXchange</title>
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

        .resources-section {
            padding: 50px 20px;
            text-align: center;
        }

        .resources-section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .resources-section p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        .resources-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .resource-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 300px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .resource-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #007bff;
        }

        .resource-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .details-section {
            margin-top: 50px;
            text-align: left;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .details-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .details-section p {
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .details-section ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        .details-section ul li {
            margin-bottom: 10px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h3 {
            font-size: 1.5rem;
            cursor: pointer;
            color: #007bff;
            margin-bottom: 10px;
        }

        .faq-item p {
            font-size: 1.2rem;
            line-height: 1.8;
            display: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- RESOURCES SECTION -->
    <div class="resources-section">
        <br>
        <br>
        <br>

        
        <h1>Resources</h1>
        <p>Explore our guides, tools, and resources to make the most of ImpactXchange.</p>
        <div class="resources-cards">
            <!-- Donor Guide -->
            <div class="resource-card">
                <h3><i class="fas fa-hand-holding-heart"></i> Donor Guide</h3>
                <p>Learn how to donate effectively and make a real impact.</p>
            </div>

            <!-- NGO Resources -->
            <div class="resource-card">
                <h3><i class="fas fa-users"></i> NGO Resources</h3>
                <p>Access tools and tips to maximize your organization's reach.</p>
            </div>

            <!-- Blog -->
            <div class="resource-card">
                <h3><i class="fas fa-blog"></i> Blog</h3>
                <p>Read inspiring stories and updates from our community.</p>
            </div>

            <!-- FAQs -->
            <div class="resource-card">
                <h3><i class="fas fa-question-circle"></i> FAQs</h3>
                <p>Find answers to common questions about ImpactXchange.</p>
            </div>
        </div>
          <!-- Details Section -->
          <div class="details-section">
            <h2>Donor Guide</h2>
            <p>Learn how to donate effectively and make a real impact.</p>
            <ul>
                <li>Sign up as a donor on our platform.</li>
                <li>Browse the list of NGO requests.</li>
                <li>Select the items you wish to donate.</li>
                <li>Coordinate with the NGO for delivery or pickup.</li>
            </ul>
        </div>

        <div class="details-section">
            <h2>NGO Resources</h2>
            <p>Access tools and tips to maximize your organization's reach.</p>
            <ul>
                <li>Sign up as an NGO on our platform.</li>
                <li>Complete your profile with accurate details.</li>
                <li>Submit verification documents for approval.</li>
                <li>Engage with donors through timely communication.</li>
            </ul>
        </div>

        <div class="details-section">
            <h2>Blog</h2>
            <p>Read inspiring stories and updates from our community.</p>
            <ul>
                <li>How Donations Change Lives</li>
                <li>Top 10 Donated Items</li>
                <li>Success Stories from NGOs</li>
            </ul>
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <h2>FAQs</h2>
            <div class="faq-item">
                <h3 onclick="toggleFaq(this)">How do I donate items?</h3>
                <p>Sign up as a donor, browse NGO requests, and coordinate for delivery or pickup.</p>
            </div>
            <div class="faq-item">
                <h3 onclick="toggleFaq(this)">How do NGOs register?</h3>
                <p>NGOs can register by signing up and submitting verification documents.</p>
            </div>
            <div class="faq-item">
                <h3 onclick="toggleFaq(this)">Is there a fee for using the platform?</h3>
                <p>No, ImpactXchange is free for both donors and NGOs.</p>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include("footer.php"); ?>

    <script>
        function toggleFaq(faqHeader) {
            const answer = faqHeader.nextElementSibling;
            if (answer.style.display === "block") {
                answer.style.display = "none";
            } else {
                answer.style.display = "block";
            }
        }
    </script>
</body>

</html>