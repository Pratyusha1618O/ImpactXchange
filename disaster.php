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
  <title>Disaster Relief Stories</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    /* .header {
      text-align: center;
      padding: 2rem 1rem;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
    }

    .header h1 {
      font-size: 2.5rem;
      margin: 0;
    }

    .header p {
      font-size: 1.2rem;
      margin-top: 0.5rem;
    } */

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-content {
      padding: 1.5rem;
    }

    .card-content h2 {
      font-size: 1.5rem;
      color: #6a11cb;
      margin-bottom: 1rem;
    }

    .card-content p {
      font-size: 1rem;
      line-height: 1.6;
      color: #555;
    }

    .footer {
      text-align: center;
      padding: 1rem;
      background: #333;
      color: white;
      margin-top: 2rem;
    }

    .footer p {
      margin: 0;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <div class="header">
    <h1><i class="fas fa-hands-helping"></i> Disaster Relief Stories</h1>
    <p>Learn how we made a difference during natural disasters</p>
  </div>

  <div class="container">
    <div class="card-grid">
      <!-- Card 1 -->
      <div class="card">
        <img src="https://media.assettype.com/TNIE%2Fimport%2F2020%2F5%2F21%2Foriginal%2FNDRF_men_1.jpg?w=480&auto=format%2Ccompress&fit=max" alt="Cyclone Amphan">
        <div class="card-content">
          <h2>How We Helped During Cyclone Amphan</h2>
          <p>
            In 2020, Cyclone Amphan devastated coastal West Bengal. Our team distributed over 1,000 food kits and 2,500 clothing items in affected regions like Sundarbans. Emergency shelters and medical aid were also arranged in collaboration with NGOs.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxIcut6tWfFc09i3yF76_uFL9mZjp5F8NDeQ&s" alt="Cyclone Fani">
        <div class="card-content">
          <h2>Emergency Relief for Cyclone Fani Victims</h2>
          <p>
            After Cyclone Fani struck in 2019, volunteers rushed to Odisha and southern Bengal districts. Relief included tarpaulin, dry food packets, and hygiene kits, aiding more than 3,000 families during the post-cyclone recovery period.
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <img src="https://img.etimg.com/thumb/width-1200,height-900,imgsize-346026,resizemode-75,msid-113521849/news/india/junior-doctors-provide-flood-relief-in-bengal-amid-partial-protest-withdrawal.jpg" alt="Flood Relief">
        <div class="card-content">
          <h2>Flood Rescue in South Bengal</h2>
          <p>
            Heavy monsoon floods displaced hundreds in rural South Bengal. Our mobile van units delivered clean water, baby food, and essential supplies while our team helped rebuild damaged homes with community support.
          </p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="card">
        <img src="https://cdn.i-scmp.com/sites/default/files/d8/images/canvas/2025/03/05/6a56a90f-b2ad-4841-a426-bd7eb5932887_efbad539.jpg" alt="Cyclone Yaas">
        <div class="card-content">
          <h2>Quick Response for Cyclone Yaas</h2>
          <p>
            When Cyclone Yaas hit in 2021, we launched a 48-hour response mission. Our volunteers coordinated with local authorities to deliver resources, setup shelters, and distribute over 5 tons of supplies within days.
          </p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="card">
        <img src="https://i1.wp.com/speciesinperil.unm.edu/wp/wp-content/uploads/2020/05/12-cyclone-relief-supply-distribution-II-am.jpg?resize=825%2C580&ssl=1" alt="Sundarbans Relief">
        <div class="card-content">
          <h2>Helping Remote Villages in Sundarbans</h2>
          <p>
            In the aftermath of a lesser-known 2022 storm, our platform helped raise awareness and collect donations for remote Sundarban villages. Hundreds received mosquito nets, rice bags, and solar lamps in the blackout-stricken zones.
          </p>
        </div>
      </div>
      <!-- Card 6 -->
<div class="card">
  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjqq9JoY6Q_43dmf_YQ9yA6y1Ar0dGYWCxCg&s" alt="Kerala Floods Relief">
  <div class="card-content">
    <h2>Kerala Floods Relief Efforts</h2>
    <p>
      During the devastating Kerala floods of 2018, our team worked tirelessly to provide relief to affected families. Over 10,000 food kits, clean drinking water, and medical supplies were distributed. We also helped rebuild homes and schools in the worst-hit areas.
    </p>
  </div>
</div>
    </div>
  </div>


</body>
</html>

<?php
 include("footer.php");
?>