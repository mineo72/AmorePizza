<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Home | AmorayPizza</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/nav.css" rel="stylesheet" />
    <link
      href="../images/amorayLogoConcept.png"
      rel="icon"
      type="image/x-icon"
    />
    <script type="text/javascript" src="../javascript/scripts.js"></script>
  </head>
  <body>
    <div class="parallax" id="pageimage"><br>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a href="index.php" class="active">Home</a></li>
        <li class="linav"><a href="menu.html">Menu</a></li>
        <li class="linav"><a href="about.html">About</a></li>
        <li class="linav"><a href="contact.html">Contact</a></li>
        <a href="account.html" id="accountImg" alt="User Account"></a>
        <div class="dropdown" id="dropdown">
          <button onclick="dropdownFunction()" class="dropbtn"><img src="../images/cart.png" class="cartImg" /><span id="cartText">Cart</span><?php
		          $priceTotal = 0;
		          if (isset($_COOKIE["cart"])){
			          $cartArray = explode(',',$_COOKIE["cart"]);
			          foreach ($cartArray as $cartItem){
				          $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
				          $result = $conn->query($sql);
				          $row = $result->fetch_assoc();
				          $priceTotal = $priceTotal+$row["item_price"];
			          }
			          ?><span>$<?=$priceTotal?></span><?php
		          }else{
			          echo "$0.00";
		          }
	          ?></button>
          <!--add code to change the price to the current cart price-->
          <!--Cart-->
          <div id="myDropdown" class="dropdown-content">
            <!--Add code here to make an <a> tag for each item added to the cart. Replace the sizes below. Each item should have an id and link to their product page when clicked-->
            <!--Content should scroll when more than 4 items are in the cart-->
            <!--When hovered, desc. of item is shown. When not hovered, only the name and price are shown-->
	          <?php
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
	          ?>
            <button class="checkout" onclick="location.href='checkout.html'" >Checkout</button>
          </div>
        </div>
      </ul>
    </div>
    <div class="page">
      <!--Ad slideshow/rotation-->
      <div class="test" style="max-width: 900px">
        <a href="page.html"
          ><img
            class="slideAd"
            src="../images/amorayLogoTextConcept.png"
            style="width: 100%"
        /></a>
        <a href="page.html"
          ><img
            class="slideAd"
            src="../images/amorayLogoConcept.png"
            style="width: 100%"
        /></a>
      </div>
      <script>
        //Slideshow carousel
        var myIndex = 0;
        carousel();

        window.onscroll = function() {scrollFunction()};
      </script>
      <!--End of ad slideshow-->
    </div>
    <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
  </body>
</html>
