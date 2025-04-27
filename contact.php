<?php
 include("header.php");
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
    </style>
</head>

<body>
    <div class="contact-section">
        <br>
        <br>
        <br>
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Fill out the form below or reach out to us directly.</p>

        <!-- Contact Form -->
        <div class="contact-form">
            <form action="submit_contact.php" method="POST">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            <h3>Our Contact Details</h3>
            <p><i class="fas fa-envelope"></i> Email: <a href="mailto:support@impactxchange.com">support@impactxchange.com</a></p>
            <p><i class="fas fa-phone"></i> Phone: +1 (123) 456-7890</p>
            <p><i class="fas fa-map-marker-alt"></i> Address: 123 Impact Street, City, Country</p>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include("footer.php"); ?>
</body>

</html>