<?php

?>

<html>
<script src="https://kit.fontawesome.com/63ce28b4a6.js" crossorigin="anonymous"></script>

<style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

html {
  overflow-x: hidden;
  scroll-behavior: smooth;
}

:root{
  --bg-color: #ffffff;
  --second-bg-color: #f9f8f8;
  --text-color: #000000;
  --violet: #9B87F5;
  --blue: #07145f;
  --shadow: #494949a1;
  --grey: #4c4b4b;
  --yellow: #fff237;
  --pink: pink;
  --orange: #F97316;
  --white: #fff;
  --red: #ea384c;
  --magenta: #ff2d6c;
  --shadow: #acacac;
  --hover-shadow: #c9c9c9;
}


/* NAVBAR */
nav {
  display: flex;
  justify-content: space-between;
  padding: 1.5rem 3rem;
  /* background-color: #ff3e88bd; */
  background-color: var(--bg-color);
  color: var(--blue);
  position: fixed;
  width: 100%;
  z-index: 1;
  top: 0;
  left: 0;
  box-shadow: 0 0 10px;
}

nav .nav-right ul li {
  list-style: none;
  color: var(--blue);
  font-size: 17px;
  font-size: 17px;
}

nav .nav-right ul li a {
  text-decoration: none;
  color: var(--blue);
}

nav .nav-right ul li a:hover {
  /* filter: drop-shadow(0 0 10px); */
  transition: 0.2s ease-in-out;
  color: var(--orange);
}

nav .nav-right ul {
  display: flex;
  gap: 2rem;

}

.nav-left p {
  font-size: 20px;
  font-weight: bold;
  font-family: "Saira", sans-serif;
}

/* OFF SCREEN MENU BAR */

.off-screen-menu {
  background-color: rgba(255, 255, 255, 0.803);
  height: 80vh;
  width: 100%;
  top: 100%;
  max-width: 400px;
  right: -450px;
  flex-direction: column;
  gap: 2rem;
  transition: 0.8s ease;
  padding: 2rem;
  box-shadow: 0 5px 10px;
  border-bottom-left-radius: 10px;
  position: absolute;
  z-index: 100;
}

.off-screen-menu.active {
  right: 0;
  z-index: 3;
}

.off-screen-menu h2 {
  text-align: center;
}

.off-screen-menu img {
  text-align: center;
}

.off-screen-menu ul li {
  list-style: none;
  padding: 0.4rem;
  margin: 1rem;
  border: 1px solid #adadad;
  text-align: center;
  border-radius: 30px;
}

.off-screen-menu ul li:hover {
  transform: scale(1.05);
  transition: 250ms;
  background-color: #d8f6dc;
  box-shadow: 0 0 2px #4540a8 inset, 5px 5px 5px #4540a8;
}

.off-screen-menu ul li a {
  text-decoration: none;
  color: var(--blue);
}

#browseBtn {
  cursor: pointer;
}

.off-screen-menu ul li:last-child {
  transform: none;
  box-shadow: none;
  border: none;
  background-color: transparent;
}

#menu-bar {
  font-size: 2rem;
  display: none;
}
</style>
<body>
    <!-- Navbar -->
    <nav class="header">
        <div class="nav-left">
            <p>Impact<span style="color: #ff2d6c;">Xchange</span></p>
        </div>

        <i class="fa-solid fa-bars" id="menu-bar"></i>

        <div class="nav-right">
            <ul>
                <li><a href="index.php#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="index.php#roadmap">How It Works</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php">SignUp/Login</a></li>
                <li id="browseBtn">Browse Our Services <i class="fa-solid fa-sliders"></i></li>
            </ul>
        </div>

        <!-- SLIDEBAR || Main Menus -->
        <div class="off-screen-menu">
            <h2>Our Services<i class="fa-solid fa-handshake-angle"></i></h2>
            <ul>
                <li><a href="#">View Products</a></li>
                <li><a href="#">Sell/Donate</a></li>
                <li><a href="ngoRegistration.php">NGO Collaboration</a></li>
                <li><a href="#">Disaster Relief</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><img src="./assets/love.png" alt="img" width="150"></li>
            </ul>
    
        </div>
    </nav>

    <!-- <script src="./script_index.js"></script> -->
    <script>
      const browseBtn = document.getElementById("browseBtn");
      console.log(browseBtn.innerHTML);


      const offScreenMenu = document.querySelector(".off-screen-menu");
      const browseBtnIcon = document.querySelector(".fa-sliders")
      browseBtn.addEventListener("click", ()=>{
          browseBtn.classList.toggle("active");
          offScreenMenu.classList.toggle("active");
          browseBtnIcon.classList.toggle("fa-xmark")
      })

      // MENU BAR RESPONSIVE
      const menuBar = document.getElementById("menu-bar");
      const navbarIcon = document.querySelector(".nav-right");

      menuBar.addEventListener("click", ()=>{
          navbarIcon.classList.toggle('active');
          menuBar.classList.toggle('fa-xmark');
      })





    </script>

</body>
</html>