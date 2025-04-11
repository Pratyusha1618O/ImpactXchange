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




