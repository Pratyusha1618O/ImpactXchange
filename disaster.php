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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Disaster Relief Blogs</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>

  <style>
    body {
      margin-top: 4rem;
      color: #f9f8f8;
    }

    .container {
      max-width: 1200px;
      margin: 60px auto;
      padding: 20px;
    }

    .page-title {
      text-align: center;
      font-size: 2.5rem;
      color: #6a11cb;
      margin-bottom: 50px;
    }

    .card {
      display: flex;
      align-items: center;
      margin-bottom: 60px;
      border-radius: 20px;
      background: white;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: scale(1.01);
    }

    .card.left {
      flex-direction: row;
    }

    .card.right {
      flex-direction: row-reverse;
    }

    .card-image {
      width: 40%;
      height: 100%;
      background: linear-gradient(135deg, #f97316, #fff237);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      color: white;
      font-size: 2rem;
      font-weight: bold;
      /* border-top-right-radius: 30px;
      border-bottom-right-radius: 30px; */
    }


    .card-content {
      width: 60%;
      padding: 40px;
    }

    .card-content h2 {
      font-size: 1.8rem;
      color: #6a11cb;
      margin-bottom: 10px;
    }

    .card-content p {
      font-size: 1rem;
      line-height: 1.6;
      color: #444;
    }

    @media (max-width: 768px) {
      .card {
        flex-direction: column !important;
      }
      .card-image, .card-content {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1 class="page-title"><i class="fas fa-hands-helping"></i> Disaster Relief Stories</h1>

    <!-- Card 1 -->
    <div class="card left">
      <div class="card-image">Cyclone Amphan</div>
      <div class="card-content">
        <h2>How We Helped During Cyclone Amphan</h2>
        <p>
          In 2020, Cyclone Amphan devastated coastal West Bengal. Our team distributed over 1,000 food kits and 2,500 clothing items in affected regions like Sundarbans. Emergency shelters and medical aid were also arranged in collaboration with NGOs.
        </p>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card right">
      <div class="card-image">Cyclone Fani</div>
      <div class="card-content">
        <h2>Emergency Relief for Cyclone Fani Victims</h2>
        <p>
          After Cyclone Fani struck in 2019, volunteers rushed to Odisha and southern Bengal districts. Relief included tarpaulin, dry food packets, and hygiene kits, aiding more than 3,000 families during the post-cyclone recovery period.
        </p>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card left">
      <div class="card-image">Flood 2021</div>
      <div class="card-content">
        <h2>Flood Rescue in South Bengal</h2>
        <p>
          Heavy monsoon floods displaced hundreds in rural South Bengal. Our mobile van units delivered clean water, baby food, and essential supplies while our team helped rebuild damaged homes with community support.
        </p>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="card right">
      <div class="card-image">Cyclone Yaas</div>
      <div class="card-content">
        <h2>Quick Response for Cyclone Yaas</h2>
        <p>
          When Cyclone Yaas hit in 2021, we launched a 48-hour response mission. Our volunteers coordinated with local authorities to deliver resources, setup shelters, and distribute over 5 tons of supplies within days.
        </p>
      </div>
    </div>

    <!-- Card 5 -->
    <div class="card left">
      <div class="card-image">Sundarban Storm</div>
      <div class="card-content">
        <h2>Helping Remote Villages in Sundarbans</h2>
        <p>
          In the aftermath of a lesser-known 2022 storm, our platform helped raise awareness and collect donations for remote Sundarban villages. Hundreds received mosquito nets, rice bags, and solar lamps in the blackout-stricken zones.
        </p>
      </div>
    </div>

  </div>
</body>
</html>

<?php
 include("footer.php");
?>
