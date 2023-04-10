<?php
$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
$adPizza = rand(1,13)
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Home | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet"/>
    <link href="../css/function/nav.css" rel="stylesheet"/>
    <link href="../css/content/home.css" rel="stylesheet"/>
    <link
      href="../images/amorayLogo.png"
      rel="icon"
      type="image/x-icon"
    />
    <script type="text/javascript" src="../javascript/scripts.js"></script>
  </head>
  <body>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a class="active">Home</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'menu.php';}, 300), pageTransitionOut();;">Menu</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'about.php';}, 300), pageTransitionOut();;">About</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'contact.php';}, 300), pageTransitionOut();;">Contact</a></li>
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
        <img src="https://img.icons8.com/ios-filled/256/gear.png" class="navIcon" alt="User Account" onclick="setTimeout(function () {location.href = 'settings.php';}, 300), pageTransitionOut();;"></a></li>
        <img src="https://img.icons8.com/material-outlined/256/help.png" class="navIcon" alt="User Account" onclick="setTimeout(function () {location.href = 'settings.php';}, 300), pageTransitionOut();;"></a></li>
      </ul>
    </div>
    <div id="content">
      <div class="parallax" id="pageimage"><br>
      <button id="orderToday" onClick="document.getElementById('homeSpacing').scrollIntoView();">Order Today!</button>
      <div class="divider" id="homeSpacing">
        <span class="title">Specials</span>
      </div>
      <div id="buyMore">
        <button id="closeAd" onclick="closeAd()">X</button>
        <?php
            $php = "select * from `amoray-pizza`.pizza_type where pizza_type_id = $adPizza";
            $result=$conn->query($php);
            $row = $result->fetch_assoc();
        ?>
        <center><img src="../images/products/pizza<?=$adPizza?>.jpg" alt="image" class="menuItemImg adImage">
        <span class="subtitle" id="typeUnderline"><?=$row["pizza_type_name"]?></span><br>
        <span class="description"><?=$row["pizza_description"]?></span><br>
        <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/pizza/templatePizza.php?type=<?=$row["pizza_type_id"]?>';}, 300), pageTransitionOut();;">Add to Cart</button></center>
      </div>
      <div class="page">
          <!--Pizzas--->
          <div id="items">
            <div class="container">
              <div class="productImg">
                <h1 class="productImgText">Amoray Signature Pizza</h1>
              </div><br>
              <div class="middle">
                <p>A stuffed crust pizza in the shape of the AmorayPizza logo.</p><br>
                <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/pizza/templatePizza.php?type=2';}, 300), pageTransitionOut();;">Customize</button>
              </div>
            </div>
            <div class="container">
              <div class="productImg">
                <h1 class="productImgText">Boneless Wings (8 ct.)</h1>
              </div><br>
              <div class="middle">
                <p>Amoray signature boneless wings drenched in a sauce of your choosing.</p><br>
                <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/wings/templateWings.php?type=4';}, 300), pageTransitionOut();;">Customize</button>
              </div>
            </div>
            <div class="container">
              <div class="productImg">
                <h1 class="productImgText">Amoray Salad</h1>
              </div><br>
              <div class="middle">
                <p>The classic Amoray salad is a sight to behold.</p><br>
                <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/sides/templateSidesSalad.php?type=1';}, 300), pageTransitionOut();;">Customize</button>
              </div>
            </div>
            <div class="container">
              <div class="productImg">
                <h1 class="productImgText">Amoray Brownies (8 ct.)</h1>
              </div><br>
              <div class="middle">
                <p>These dark chocolate fudge brownies come with drizzled chocolate syrup and powdered sugar.</p><br>
                <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/sides/templateSides.php?type=15';}, 300), pageTransitionOut();;">Customize</button>
              </div>
            </div>
          </div>
        <!--Ad slideshow/rotation-->
        <div class="test" style="max-width: 900px">
          <a href="/html/menuItems/pizza/amoraySigPizza.html"><img class="slideAd" src="../images/products/ads/amoraySigPizzaAd.png" style="width: 100%" alt="Ad for Amoray Signature Pizza"/></a>
          <a href="/html/menuItems/wings/bonelessWings.html"><img class="slideAd" src="../images/products/ads/bonelessWingAd.png" style="width: 100%" alt="Ad for boneless wings"/></a>
          <a href="/html/menuItems/wings/boneWings.html"><img class="slideAd" src="../images/products/ads/boneWingAd.png" style="width: 100%" alt="Ad for bone in wings"/></a>
          <a href="/html/menuItems/more/brownieSingleMore.html"><img class="slideAd" src="../images/products/ads/brownieMoreAd.png" style="width: 100%" alt="Ad for brownies"/></a>

          <center><button class="buttonSubmit buttonBounce" name="Submit"  onclick="setTimeout(function () {location.href = 'menu.php';}, 300), pageTransitionOut();;">Full Menu ></button></center>
          <script>
          //Slideshow carousel
          var myIndex = 0;
          carousel();
          pageTransitionIn();
          setTimeout(buyMore, 2000);
          window.onscroll = function() {scrollFunction()};
        </script>
        <!--End of ad slideshow-->
      </div>
      <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
    </div>
  </body>
</html>
