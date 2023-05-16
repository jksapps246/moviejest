// Please see documentation at https://docs.microsoft.com/aspnet/core/client-side/bundling-and-minification
// for details on configuring this project to bundle and minify static web assets.

// Write your JavaScript code.

let searchBox = document.querySelector('#searchBox');
searchBox.focus();

// YouTube Player Slide-up/Slide-down
let ytPlayer = document.querySelector('#youtubePlayer');

let isOpen = false;
function togglePlayer() {
    if(isOpen) {
        $('#youtubePlayer').animate({
            marginTop: '800px'
        }, 300, 'swing');
        isOpen = false;
    } else {        
        $('#youtubePlayer').animate({
            marginTop: '15px'
        }, 360, 'swing');
        isOpen = true;
    }
}
function setTrailer(player,value) {
 document.getElementById(player).src = "https://www.youtube.com/embed/"+value+ "?rel=0&enablejsapi=1";
}
function showBio() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("bioButton");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "[Read more]"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "[Read less]"; 
      moreText.style.display = "inline";
    }
  }
  function setDetails(title,date,lang, bio, url){
    var dTitle = document.getElementById("dTitle");
    var dDate = document.getElementById("dDate");
    var dLang = document.getElementById("dLang");
    var dBio = document.getElementById("dBio");
    var dUrl = document.getElementById("dUrl");

    dTitle.innerHTML =  title;
    dDate.innerHTML =  date;
    dLang.innerHTML =  lang;
    dBio.innerHTML =  bio;
    dUrl.style.url =  url;
  }

  function dropDownMenu(x) {
    x.classList.toggle("change");
  }

