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
    //Event listeners for both navigation and top button
    window.addEventListener('scroll', navFunction);
    window.addEventListener('scroll', scrollFunction2);




//Mobile navigation
function openNav() {
    document.getElementById("ulnav").style.height = "550px";
    document.getElementById("ulnav").style.marginBottom = "260px";
    document.getElementById("ulnav").style.border = "5px solid #d3d3d3";
    document.getElementById("ulnav").style.marginLeft = "-4px";

    document.getElementById("openNav").style.display = "none";

    document.getElementById("closeNav").style.display = "block";
  }

  function closeNav() {
    document.getElementById("ulnav").style.height = "60px";
    document.getElementById("ulnav").style.marginBottom = "0px";
    document.getElementById("ulnav").style.border = "1px solid #d3d3d3";
    document.getElementById("ulnav").style.marginLeft = "0px";

    document.getElementById("closeNav").style.display = "none";

    document.getElementById("openNav").style.display = "block";
  }

