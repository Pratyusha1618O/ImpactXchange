<?php
 session_start();
 include("./server/config.php");

 if(isset($_SESSION['email'])){
     include("user_logged_in_nav.php");
 }
 else if(isset($_SESSION["ngo-email"])){
    include("ngo_loggedin_nav.php");    
}
else if(isset($_SESSION["admin-email"])){
    include("admin_loggedin_nav.php");    
}
 else{
     include("header.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/63ce28b4a6.js" crossorigin="anonymous"></script>
    <title>About</title>
    
    <link rel="stylesheet" href="./style_index.css">
    <link rel="stylesheet" href="./responsive.css">
    <style>
        body {
            
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }


        .hero-section h1 {
            font-size: 3rem;
            z-index: 2;
            margin: 0;
        }

        .hero-section p {
            font-size: 1.5rem;
            z-index: 2;
            margin-top: 10px;
        }

        .about-section {
            margin-top: 4rem;
            padding: 50px 20px;
            text-align: center;
        }

        .about-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .about-header p {
            font-size: 1.2rem;
            color: #555;
        }

        .about-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .about-text {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            text-align: left;
        }

        .about-text h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .about-text p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .about-text ul {
            list-style: none;
            padding: 0;
        }

        .about-text ul li {
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .about-text ul li::before {
            content: '\f058';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #007bff;
            margin-right: 10px;
        }

        .about-image img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .team-section {
            background: #f9f9f9;
            padding: 50px 20px;
            text-align: center;
        }

        .team-section h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .team-members {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .team-member {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 250px;
            width: 40vw;
        }

        .team-member img {
            border-radius: 50%;
            margin-bottom: 15px;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .team-member h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>

<body>


    <!-- ABOUT SECTION -->
    <div class="about-section">
        <div class="about-header">
            <h1>Who We Are</h1>
            <p>Learn more about our mission, vision, and values.</p>
        </div>
        <div class="about-content">
            <div class="about-text">
                <h2>Our Mission</h2>
                <p>
                    At ImpactXchange, we aim to bridge the gap between donors and NGOs by providing a platform that
                    facilitates the donation of essential items to those in need. Whether it's disaster relief, community
                    support, or empowering underserved areas, we are here to make a difference.
                </p>
                <h2>What We Do</h2>
                <p>
                    We connect individuals and organizations with verified NGOs to ensure that donations reach the right
                    hands. Our platform enables donors to give items they no longer use, while NGOs can request specific
                    needs for their programs.
                </p>
                <h2>Why Choose Us?</h2>
                <ul>
                    <li>Transparent and secure donation process.</li>
                    <li>Real-time disaster relief activation.</li>
                    <li>Support for remote and underserved communities.</li>
                </ul>
            </div>
        </div>
    </div>

    ...
    <!-- TEAM SECTION -->
    <div class="team-section">
        <h1>Meet Our Team</h1>
        <div class="team-members">
            <div class="team-member">
                <h4>Samit Kumar Desmukh</h4>
                <h4>Pratyusha Bhandary</h4>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <h4>Jyoti Kumari Shaw</h4>
                <p>Operations Manager</p>
            </div>
            <div class="team-member">
                <h4>Sayan Porey</h4>
                <p>Community Outreach</p>
            </div>
        </div>
    </div>

   

    <!-- FOOTER -->
    <?php include("footer.php"); ?>
</body>

</html>