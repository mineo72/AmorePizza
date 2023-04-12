function pageTransitionIn() {
  document.getElementById("content").style.animation = "pageMoveIn 1s ease 1 normal forwards";
}

function pageTransitionOut() {
  document.getElementById("content").style.animation = "pageMoveOut 0.3s ease 1 normal forwards";
  closeThatNav();
}

function foodTransition() {
  document.getElementById("content").style.animation = "pageMoveOut 0.3s ease 1 normal forwards";
  closeThatNav();
}

function pageTransitionInAlternate() {
  document.getElementById("content").style.animation = "pageMoveInAlternate 1s ease 1 normal forwards";
}

function buyMore() {
  document.getElementById("buyMore").style.animation = "popup 1s ease 1 normal forwards";
  document.getElementById("buyMore").style.display = "block";
}

function closeAd(){
  document.getElementById("buyMore").style.display = "none";
}

//Scroll back to top
var mybutton = document.getElementById("myBtn");
  function scrollFunction2() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

//Slideshow carousel
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("slideAd");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {
    myIndex = 1;
  }
  x[myIndex - 1].style.display = "block";
  setTimeout(carousel, 4000); // Change image every 4 seconds
}

//Mobile navigation
function openNav() {
  document.getElementById("ulnav").style.height = "750px";
  document.getElementById("ulnav").style.marginBottom = "360px";

  document.getElementById("openNav").style.display = "none";
  document.getElementById("closeNav").style.display = "block";
}

function closeNav() {
  document.getElementById("ulnav").style.height = "75px";
  document.getElementById("ulnav").style.marginBottom = "0px";

  document.getElementById("closeNav").style.display = "none";
  document.getElementById("openNav").style.display = "block";
}


//Drop Down Menu
function dropdownFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var b;
    for (b = 0; b < dropdowns.length; b++) {
        var openDropdown = dropdowns[b];
        if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        }
    }
    }
}

// When the user scrolls down 20px from the top of the document, slide down the navbar
function scrollFunction() {
  if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
    document.getElementById("navbox").style.width = "100%";
    document.getElementById("navbox").style.marginTop = "-1px";

    document.getElementById("ulnav").style.height = "75px";
    document.getElementById("ulnav").style.paddingTop = "10px";
    document.getElementById("ulnav").style.borderRadius = "0px";
    document.getElementById("ulnav").style.marginLeft = "-1px";

    document.getElementById("buttonTop").style.marginRight = "15px";
    scrollExtended();
  } else {
    closeThatNav();
  }
}

function closeThatNav() {
  document.getElementById("navbox").style.width = "98%";
    document.getElementById("navbox").style.marginTop = "10px";
    
    document.getElementById("ulnav").style.height = "60px";
    document.getElementById("ulnav").style.paddingTop = "0px";
    document.getElementById("ulnav").style.borderRadius = "10px";
    document.getElementById("ulnav").style.marginLeft = "0px";

    document.getElementById("buttonTop").style.marginRight = "-100px";
}

function scrollExtended() {
  document.getElementById("closeNav").style.display = "none";
  document.getElementById("openNav").style.display = "block";
}