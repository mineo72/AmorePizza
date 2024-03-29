<?php
include '..\outclude.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>HELP!!!1!! | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet" />
    <link href="../css/function/nav.css" rel="stylesheet" />
    <link href="../css/content/info.css" rel="stylesheet" />
    <link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../../javascript/scripts.js"></script>
  </head>
  <style>
    body{
      background-image: url("https://media4.giphy.com/media/xT1R9Xi59OaTVaxUJ2/giphy.gif");
      background-size: 2000px;
      background-position-y: -400px;
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
    }
    .content{
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
      border: 1px solid white;
    }
    .people{
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
      border: 1px solid white;
    }
    .person{
      border: 1px solid white;
    }
    .divider{
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
      /*background-color: #f7ad4557*/
      border: 1px solid white;
    }
    .imageLarge{
      border: 3px solid black;
    }
    .imageMedium{
      border: 3px solid white;
    }
    .title{
      animation: rainbow 2.5s linear;
      animation-iteration-count: infinite;
    }
    .subtitle{
      color: white;
    }
    .textBody{
      color: white;
    }
    .textMedium{
      color: white;
    }
    #ulnav{
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
    }
    .dropbtn{
      background-color: rgba(0, 0, 0, 0);
    }
    #buttonTop{
      animation: rainbow-bg 2.5s linear;
		  animation-iteration-count: infinite;
      border: 1px solid white;
    }


    @keyframes rainbow-bg{
		100%,0%{
			background-color: rgba(255, 0, 0, 0.3);
		}
		8%{
			background-color: rgb(255,127,0, 0.3);
		}
		16%{
			background-color: rgb(255,255,0, 0.3);
		}
		25%{
			background-color: rgb(127,255,0, 0.3);
		}
		33%{
			background-color: rgb(0,255,0, 0.3);
		}
		41%{
			background-color: rgb(0,255,127, 0.3);
		}
		50%{
			background-color: rgb(0,255,255, 0.3);
		}
		58%{
			background-color: rgb(0,127,255, 0.3);
		}
		66%{
			background-color: rgb(0,0,255, 0.3);
		}
		75%{
			background-color: rgb(127,0,255, 0.3);
		}
		83%{
			background-color: rgb(255,0,255, 0.3);
		}
		91%{
			background-color: rgb(255,0,127, 0.3);
		}
}

@keyframes rainbow{
		100%,0%{
			color: rgb(255,0,0);
		}
		8%{
			color: rgb(255,127,0);
		}
		16%{
			color: rgb(255,255,0);
		}
		25%{
			color: rgb(127,255,0);
		}
		33%{
			color: rgb(0,255,0);
		}
		41%{
			color: rgb(0,255,127);
		}
		50%{
			color: rgb(0,255,255);
		}
		58%{
			color: rgb(0,127,255);
		}
		66%{
			color: rgb(0,0,255);
		}
		75%{
			color: rgb(127,0,255);
		}
		83%{
			color: rgb(255,0,255);
		}
		91%{
			color: rgb(255,0,127);
		}
}

  </style>
  <body>
    <!--Back to top button-->
    <!--<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>-->

    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <!--<li class="linav"><a href="index.php">Home</a></li>
        <li class="linav"><a href="menu.php">Menu</a></li>-->
        <li class="linav"><a href="../html/about.php" class="active">Help</a></li><!--
        <li class="linav"><a href="contact.php">Contact</a></li>-->
        <a href="account.html" id="accountImg" alt="User Account"></a>
	      <div class="dropdown" id="dropdown">
		
		      <button onclick="dropdownFunction()" class="dropbtn"><img src="../images/cart.png" class="cartImg">
			      <span id="cartText">Cart</span>
			      <?php
				      $priceTotal = 0;
				      if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])||isset($_COOKIE["saladCart"])){
					      if (isset($_COOKIE["pizzaCart"])){
						      $cartArray = explode(',',$_COOKIE["pizzaCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.pizza where pizza_id = '$cartItem'";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["pizza_price"];
						      }
					      }
					      if (isset($_COOKIE["saladCart"])){
						      $cartArray = explode(',',$_COOKIE["saladCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.salad where salad_id = $cartItem";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["salad_price"];
						      }
					      }
					      if (isset($_COOKIE["cart"])){
						      $cartArray = explode(',',$_COOKIE["cart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["item_price"];
						      }
					      }
					      ?><span>$<?=$priceTotal?></span><?php
				      }else{
					      echo "$0.00";
				      }
			      ?>
		      </button>
		      <!--add code to change the price to the current cart price-->
		      <div id="myDropdown" class="dropdown-content">
			      <!--Add code here to make an <a> tag for each item added to the cart. Replace the items below. Each item should have an id and link to their product page when clicked-->
			      <!--There shouldn't be anything in the cart if the user hasn't ordered anything yet. The cart should retain information about the users purchase if they close the site (cookies?)-->
			      <!--Content should scroll when more than 4 items are in the cart-->
			      <!--When hovered, desc. of item is shown. When not hovered, only the name and price are shown-->
			      <?php
				      if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])||isset($_COOKIE["saladCart"])){
					      if (isset($_COOKIE["pizzaCart"])){
						      $cartArray = explode(',',$_COOKIE["pizzaCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.pizza LEFT JOIN `amoray-pizza`.pizza_type on pizza_type_id = pizza_type where pizza_id = '$cartItem';";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      ?>
							      <a href="#Test_item"><?=$row["pizza_type_name"]?>   $<?=$row["pizza_price"]?></a>
							      <?php
						      }
					      }
					      if (isset($_COOKIE["saladCart"])){
						      $cartArray = explode(',',$_COOKIE["saladCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.salad LEFT JOIN `amoray-pizza`.salad_type on salad_type_id= salad_id where salad_id = '$cartItem';";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      ?>
							      <a href="#Test_item"><?=$row["salad_type_name"]?>   $<?=$row["salad_price"]?></a>
							      <?php
						      }
					      }
					      if (isset($_COOKIE["cart"])){
						      $cartArray = explode(',',$_COOKIE["cart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      ?>
							      <a href="#Test_item"><?=$row["item_name"]?>   $<?=$row["item_price"]?></a>
							      <?php
						      }
					      }
				      }
			      ?>
			      <button class="checkout" onclick="location.href='checkout.php'" >Checkout</button>
		      </div>
	      </div>
      </ul>
    </div>
  <br><div class="divider">
    <span class="title">Among Us</span>
  </div>
  
  <div class="content">
    <img src="../images/people/alternate/vibe-check-cursed.gif" class="imageSocial imageTypeLarge"/>
    <div class="textLarge"><center>
      <span class="title">Hjelp</span><br>
      <span class="subtitle">We need help</span><br><br></center>
      <span class="textBody">We are trapped in a really bad pizza joint that forces us to work at against our will. Morgue won't let us be free, please send help in any amount, we desperately need it. But anyways, how may I take your order?</span>
    </div>
  </div>

  <div class="divider">
    <span class="title">The Gang</span>
  </div>
  
  <div class="people">
      <div class="person">
        <img src="../images/people/alternate/giphy.gif" class="image imageTypeMedium" onclick="location.href='hedgehog.html'"/>
        <span class="textMedium" id="typeUnderline">Morgan Harper</span>
        <span class="textMedium">Sacrificial Overlord</span><br>
        <span class="textMedium" id="typeDesc">Support Hedgehog PSA: koalaman will eat your spleen. This is a warning</span>
      </div>
      <div class="person">
        <img src="../images/people/alternate/herobrine.gif" class="imageSocial imageTypeMedium"/>
        <span class="textMedium" id="typeUnderline">Spencer Augenstein</span>
        <span class="textMedium">Ruler of Realms</span>
        <span class="textMedium" id="typeDesc">Seals WILL rule the world</span>
      </div>
      <div class="person">
        <img src="../images/people/alternate/shrimp.gif" class="imageSocial typeMicah"/>
        <span class="textMedium" id="typeUnderline">Micah Olson</span>
        <span class="textMedium">Boccher</span>
        <span class="textMedium" id="typeDesc">Objectively hot troubadour</span>
      </div>
      <div class="person">
        <img src="../images/people/alternate/rickroll-roll.gif" class="imageSocial imageTypeMedium"/>
        <span class="textMedium" id="typeUnderline">Alexander Bollentino</span>
        <span class="textMedium">Severely Trapped</span>
        <span class="textMedium" id="typeDesc">help.. i'm trapped here</span>
      </div>
    </div>

    <div class="divider">
      <span class="title">The One</span>
    </div>
      <div class="people">
        <div class="person">
        <img src="../images/people/alternate/koala.jpg" class="imageMedium"/>
        <span class="textMedium" id="typeUnderline">Koalaman</span>
        <span class="textMedium">The Paradise Gatekeeper</span>
        <span class="textMedium" id="typeDesc">C#s will teach you the universe</span>
      </div>
    </div>
    <script>
      window.onscroll = function() {scrollFunction()};
    </script>
    <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
  </body>
</html>
