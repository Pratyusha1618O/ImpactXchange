<?php
session_start();
include("./server/config.php");

if (isset($_SESSION['email'])) {
  include("user_logged_in_nav.php");
} else if (isset($_SESSION["ngo-email"])) {
  include("ngo_loggedin_nav.php");
} else if (isset($_SESSION["admin-email"])) {
  include("admin_loggedin_nav.php");
} else {
  include("header.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Explore real stories of how our platform and volunteers helped during disasters like Cyclone Amphan, Kerala floods, and more. A future disaster management module is coming soon.">
  <title>Disaster Relief Stories</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin-top: 3rem;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    .head {
      text-align: center;
      padding: 2rem 1rem;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: white;
    }

    .head h1 {
      font-size: 2.5rem;
      margin: 0;
    }

    .head p {
      font-size: 1.2rem;
      margin-top: 0.5rem;
    }

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


    .hidden-card {
      display: none;
    }

    .load-more-btn {
      display: block;
      margin: 2rem auto;
      transform: translateX(60vw);
      padding: 10px 20px;
      font-size: 1rem;
      background-color: #6a11cb;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
      
    }

    .load-more-btn:hover {
      background-color: #5310a0;
    }
  </style>
</head>

<body>

  <div class="head">
    <h1><i class="fas fa-hands-helping"></i> Disaster Relief Stories</h1>
    <p>Learn how we made a difference during natural disasters</p>
  </div>

  <p style="text-align: center; font-style: italic; color: #666; margin-bottom: 2rem;" >
    <strong>Note:</strong> A complete disaster management system is under development. This section currently highlights
    past relief efforts.
  </p>


  <div class="container">
    <div class="card-grid" id="blogContainer">
      <!-- Card 1 -->
      <div class="card">
        <img
          src="https://media.assettype.com/TNIE%2Fimport%2F2020%2F5%2F21%2Foriginal%2FNDRF_men_1.jpg?w=480&auto=format%2Ccompress&fit=max"
          alt="Cyclone Amphan">
        <div class="card-content">
          <h2>How We Helped During Cyclone Amphan</h2>
          <p>
            In 2020, Cyclone Amphan devastated coastal West Bengal. Our team distributed over 1,000 food kits and 2,500
            clothing items in affected regions like Sundarbans. Emergency shelters and medical aid were also arranged in
            collaboration with NGOs.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxIcut6tWfFc09i3yF76_uFL9mZjp5F8NDeQ&s"
          alt="Cyclone Fani">
        <div class="card-content">
          <h2>Emergency Relief for Cyclone Fani Victims</h2>
          <p>
            After Cyclone Fani struck in 2019, volunteers rushed to Odisha and southern Bengal districts. Relief
            included tarpaulin, dry food packets, and hygiene kits, aiding more than 3,000 families during the
            post-cyclone recovery period.
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <img
          src="https://img.etimg.com/thumb/width-1200,height-900,imgsize-346026,resizemode-75,msid-113521849/news/india/junior-doctors-provide-flood-relief-in-bengal-amid-partial-protest-withdrawal.jpg"
          alt="Flood Relief">
        <div class="card-content">
          <h2>Flood Rescue in South Bengal</h2>
          <p>
            Heavy monsoon floods displaced hundreds in rural South Bengal. Our mobile van units delivered clean water,
            baby food, and essential supplies while our team helped rebuild damaged homes with community support.
          </p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="card">
        <img
          src="https://cdn.i-scmp.com/sites/default/files/d8/images/canvas/2025/03/05/6a56a90f-b2ad-4841-a426-bd7eb5932887_efbad539.jpg"
          alt="Cyclone Yaas">
        <div class="card-content">
          <h2>Quick Response for Cyclone Yaas</h2>
          <p>
            When Cyclone Yaas hit in 2021, we launched a 48-hour response mission. Our volunteers coordinated with local
            authorities to deliver resources, setup shelters, and distribute over 5 tons of supplies within days.
          </p>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="card">
        <img
          src="https://i1.wp.com/speciesinperil.unm.edu/wp/wp-content/uploads/2020/05/12-cyclone-relief-supply-distribution-II-am.jpg?resize=825%2C580&ssl=1"
          alt="Sundarbans Relief">
        <div class="card-content">
          <h2>Helping Remote Villages in Sundarbans</h2>
          <p>
            In the aftermath of a lesser-known 2022 storm, our platform helped raise awareness and collect donations for
            remote Sundarban villages. Hundreds received mosquito nets, rice bags, and solar lamps in the
            blackout-stricken zones.
          </p>
        </div>
      </div>
      <!-- Card 6 -->
      <div class="card">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjqq9JoY6Q_43dmf_YQ9yA6y1Ar0dGYWCxCg&s"
          alt="Kerala Floods Relief">
        <div class="card-content">
          <h2>Kerala Floods Relief Efforts</h2>
          <p>
            During the devastating Kerala floods of 2018, our team worked tirelessly to provide relief to affected
            families. Over 10,000 food kits, clean drinking water, and medical supplies were distributed. We also helped
            rebuild homes and schools in the worst-hit areas.
          </p>
        </div>
      </div>

      <!-- card 7 -->
      <div class="card hidden-card">
        <img
          src="https://imagesvs.oneindia.com/img/2013/07/16-malda-west-bengal.jpg"
          alt="Malda Floods Relief">
        <div class="card-content">
          <h2>Helping Flood-Hit Families in Malda</h2>
          <p>
            In August 2022, heavy rainfall caused severe flooding in Malda district. We reached out with dry food kits,
            baby milk powder, and mosquito nets, assisting more than 3,000 displaced villagers from the banks of the
            Ganga and Mahananda.
          </p>
        </div>
      </div>

      <!-- card 8 landslide-->
      <div class="card hidden-card">
        <img
          src="https://siliguritimes.com/wp-content/uploads/2024/10/Feature-Image-1024x576.jpg"
          alt="North Bengal Landslide Relief">
        <div class="card-content">
          <h2>Landslide Response in Kalimpong & Darjeeling</h2>
          <p>
            Torrential rains triggered deadly landslides in Kalimpong and Darjeeling in 2023. Our mountain response
            teams delivered emergency supplies via trekking routes and helped rebuild damaged roads and homes alongside
            locals and army rescue teams.
          </p>
        </div>
      </div>

      <!-- card 9 covid-->
      <div class="card hidden-card">
        <img
          src="https://www.mdpi.com/remotesensing/remotesensing-13-04395/article_deploy/html/images/remotesensing-13-04395-g001.png"
          alt="COVID Kolkata Relief">
        <div class="card-content">
          <h2>COVID Lockdown Support Across Kolkata</h2>
          <p>
            During the second wave of COVID-19 in Kolkata, we distributed ration kits, oxygen cylinders, and arranged
            home deliveries of medicine for elderly patients in containment zones. Helplines were also set up for mental
            health support and vaccination help.
          </p>
        </div>
      </div>

      <!-- card 10 remal-->
      <div class="card hidden-card">
        <img
          src="https://www.krctimes.com/wp-content/uploads/2024/05/cyclone-remal1-1716554033.jpg"
          alt="Cyclone Remal West Bengal">
        <div class="card-content">
          <h2>Post-Cyclone Remal Rehabilitation Drive</h2>
          <p>
            Cyclone Remal hit coastal Bengal in May 2024, causing heavy flooding in Kakdwip, Gosaba, and Basanti. Relief
            efforts included food kit distribution, mobile health camps, and restoring damaged school buildings in
            remote Sundarban areas.
          </p>
        </div>
      </div>

      <!-- card 11 bulbul -->
      <div class="card hidden-card">
        <img src="https://english.cdn.zeenews.com/sites/default/files/2019/11/10/829444-cyclone.jpg?im=Resize=(1200,900)" alt="Cyclone Bulbul Bengal">
        <div class="card-content">
          <h2>Helping Families Affected by Cyclone Bulbul</h2>
          <p>
            Cyclone Bulbul uprooted thousands of homes in November 2019 across North & South 24 Parganas. Our volunteers
            provided solar lamps, drinking water, dry food, and warm clothes to families whose homes were submerged or
            destroyed.
          </p>
        </div>
      </div>

      <!-- card 12 dana -->
      <div class="card hidden-card">
        <img src="https://d3lzcn6mbbadaf.cloudfront.net/media/details/ANI-20241024135252.jpg"
          alt="Cyclone Dana Bengal">
        <div class="card-content">
          <h2>Cyclone Dana: Rapid Relief for Coastal Bengal</h2>
          <p>
            Cyclone Dana caused extensive storm surges in coastal blocks of East Midnapore and Namkhana. Despite road
            blockages, our ground teams delivered tarpaulins, cooked meals, and water filters to more than 5,000 people
            in temporary shelters.
          </p>
        </div>
      </div>

      <button class="load-more-btn" id="toggleBtn">Load More ⏬</i></button>

    </div>
  </div>

  <script>
    const toggleBtn = document.getElementById("toggleBtn");
    const hiddenCards = document.querySelectorAll(".hidden-card");
    let expanded = false;

    toggleBtn.addEventListener("click", () => {
      hiddenCards.forEach(card => {
        card.style.display = expanded ? "none" : "block";
      });

      toggleBtn.textContent = expanded ? "Load More ⏬" : "Show Less ⏫";
      expanded = !expanded;
    });
  </script>



</body>

</html>

<?php
include("footer.php");
?>