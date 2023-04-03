<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>About | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet" />
    <link href="../css/function/nav.css" rel="stylesheet" />
    <link href="../css/content/info.css" rel="stylesheet" />
    <link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../javascript/scripts.js"></script>
  </head>
  <body>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'index.php';}, 300), pageTransitionOut();;">Home</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'menu.php';}, 300), pageTransitionOut();;">Menu</a></li>
        <li class="linav"><a href="../help/help.php" class="active">About</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'contact.php';}, 300), pageTransitionOut();;">Contact</a></li>
        <a id="accountImg" alt="User Account" onclick="setTimeout(function () {location.href = 'account.html';}, 300), pageTransitionOut();;"></a>
	      <div class="dropdown" id="dropdown">
		
		      <button onclick="dropdownFunction()" class="dropbtn"><img src="../../../images/cart.png" class="cartImg">
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

  <div id="content">
    <br><div class="divider">
      <span class="title">About Us</span>
    </div>
    
    <div class="content">
      <img src="../images/amorayLogo.png" class="imageSocial imageTypeLarge"/>
      <div class="textLarge"><center>
        <span class="title">Company</span><br>
        <span class="subtitle">We make pizza</span><br><br></center>
        <span class="textBody">A company that aspires to be a really delicious pizza joint. We strive to be highly supportive of our customers and employees! Feel the freedom of your taste buds as you try our spin on pizza.</span>
      </div>
    </div>

    <div class="divider">
      <span class="title">The Crew</span>
    </div>
    
    <div class="people">
        <div class="person">
          <img src="../images/people/morgue.png" class="imageSocial imageTypeMedium" onclick="location.href='../help/hedgehog.html'"/>
          <span class="textMedium" id="typeUnderline">Morgan Harper</span>
          <span class="textMedium">Project Lead</span><br>
          <span class="textMedium" id="typeDesc">Words go here</span>
        </div>
        <div class="person">
          <img src="../images/people/spencer.jpg" class="imageSocial imageTypeMedium"/>
          <span class="textMedium" id="typeUnderline">Spencer Augenstein</span>
          <span class="textMedium">Front End Lead</span>
          <span class="textMedium" id="typeDesc">Words go here</span>
        </div>
        <div class="person">
          <img src="../images/people/micah.png" class="imageSocial imageTypeMedium"/>
          <span class="textMedium" id="typeUnderline">Micah Olson</span>
          <span class="textMedium">Back End Lead</span>
          <span class="textMedium" id="typeDesc">Words go here</span>
        </div>
        <div class="person">
          <img src="../images/account.png" class="imageSocial imageTypeMedium"/>
          <span class="textMedium" id="typeUnderline">Alexander Bollentino</span>
          <span class="textMedium">PHP, Branding</span>
          <span class="textMedium" id="typeDesc">Words go here</span>
        </div>
      </div>
      <script>
        window.onscroll = function() {scrollFunction()};
        pageTransitionIn();
      </script>
      <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
    </div>
  </body>
</html>
