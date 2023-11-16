const navBar = document.querySelector('nav');

function changeNavBarBackground() {
  if (window.scrollY > 0) {
    
    navBar.classList.add('scrolled');
  } else {
    
    navBar.classList.remove('scrolled');
  }
}

window.addEventListener('scroll', changeNavBarBackground);




let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000);
}

const homeTag = document.getElementById("homeLink");
const infoTag = document.getElementById("infoLink");
const reviewsTag = document.getElementById("reviewsLink");
const safetyTag = document.getElementById("safetyLink");
const aboutTag = document.getElementById("aboutLink");
const accountTag = document.getElementById("accountLink");

homeTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
});
infoTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
})
reviewsTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
})
safetyTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
})
aboutTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
});
accountTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
});
contactTag.addEventListener('click', function(){
  document.getElementById("check").checked = false;
})


