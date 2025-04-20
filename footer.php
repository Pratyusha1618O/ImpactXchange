

<!DOCTYPE html>
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

/* SECTION 7 || FOOTER  */
.footer{
  background-color: #120a23;
  color: var(--white);
  padding: 1rem 0;
}

.sec7-subsec{
  display: flex;
  justify-content: space-around;
  margin-top: 3rem;
}

.footer-subsec .impactXchange-msg{
  font-size: 15px;
  margin: 1rem 0;
}

.footer-subsec i{
  font-size: 18px;
  margin: 10px;
}

.footer-subsec a{
  text-decoration: none;
  color: var(--white);
}

.footer-links a p{
  margin: 8px 0;
}

.footer-links h3{
  margin-bottom: 1rem;
}

/* footer line horizontal */
.footer-line{
  height: 1px;
  width: 50%;
  background-color: #80808091;
  transform: translateX(50%);
  margin: 2rem 0;
}

/* copyright */
.copyright{
  display: flex;
  justify-content: space-between;
  padding: 0 6rem;
  padding-bottom: 3rem;
}

.copyright .copyright-links a{
  margin: 0 1.5rem;
  text-decoration: none;
  color: var(--white);
}
</style>

<body>
<div class="section7 footer">
        <div class="sec7-subsec">
            <div class="footer-subsec">
                <h2 class="impactXchange">Impact<span style="color:#F97316;">Xchange</span></h2>
                <p class="impactXchange-msg">Connecting donations with those who <br>need them most, one item at a time.</p>
                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
       
            </div>
            <div class="footer-subsec footer-links">
                <h3>About</h3>
                <a href=""><p>Our Mission</p></a>
                <a href=""><p>Our Team</p></a>
                <a href=""><p>Impact Reports</p></a>
                <a href=""><p>Partner NGOs</p></a>       
            </div>
            <div class="footer-subsec footer-links">
                <h3>Resources</h3>
                <a href=""><p>Donor Guide</p></a>
                <a href=""><p>NGO Resources</p></a>
                <a href=""><p>Blog</p></a>
                <a href=""><p>FAQs</p></a>  
                
            </div>
            <div class="footer-subsec footer-links">
                <h3>Contact</h3>
                <a href=""><p>Contact Us</p></a>
                <a href=""> <p>Support</p></a>
                <a href=""><p>info@impactxchange.org</p></a>  
            </div>
        </div>

        <div class="footer-line"></div>
        

        <div class="copyright">
            <p>© 2025 ImpactXchange. All rights reserved.</p>

            <div class="copyright-links">
                <a href="">Privacy Policy</a>
                <a href="">Terms of Service</a>
            </div>
        </div>
        
    </div> 
</body>
</html>