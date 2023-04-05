<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Menu | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet" />
    <link href="../css/function/nav.css" rel="stylesheet" />
    <link href="../css/food/menu.css" rel="stylesheet" />
    <link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../javascript/scripts.js"></script>
    <script type="text/javascript" src="../javascript/settings.js"></script>
  </head>
  <body>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a onclick="pageTransitionOut(), setTimeout(function () {location.href = 'index.php';}, 300);;">Home</a></li>
        <li class="linav"><a class="active">Menu</a></li>
        <li class="linav"><a onclick="pageTransitionOut(), setTimeout(function () {location.href = 'about.php';}, 300);;">About</a></li>
        <li class="linav"><a onclick="pageTransitionOut(), setTimeout(function () {location.href = 'contact.php';}, 300);;">Contact</a></li>
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
    <!--Menu Nav-->
    <br><div id="foodbox">
      <ul id="menuCategory">
          <!--for each button: onclick open the category div and hide the other divs-->
          <li class="foodButton"><button onclick="foodProcess(), setTimeout(selectPizza, 301)" class="foodButton"><img src="../images/pizzaIcon.png" class="foodImg"><span class="foodText" id="food1">Pizza</span></button></li>
          <li class="foodButton"><button onclick="foodProcess(), setTimeout(selectWings, 301)" class="foodButton"><img src="../images/wingsIcon.png" class="foodImg"><span class="foodText" id="food2">Wings</span></button></li>
          <li class="foodButton"><button onclick="foodProcess(), setTimeout(selectSides, 301)" class="foodButton"><img src="../images/moreIcon.png" class="foodImg"><span class="foodText" id="food3">Sides</span></button></li>
          <li class="foodButton"><button onclick="foodProcess(), setTimeout(selectDrinks, 301)" class="foodButton"><img src="../images/drinksIcon.png" class="foodImg"><span class="foodText" id="food4">Drinks</span></button></li>
          <li class="foodButton"><button onclick="foodProcess(), setTimeout(selectMore, 301)" class="foodButton"><img src="../images/sidesIcon.png" class="foodImg"><span class="foodText" id="food5">Salads</span></button></li>
            
            <!--<div class="search-container">
              
              <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><img src="../images/navburger.png" style="height: 15px;"></img></button>
              </form>
            </div>-->
      </ul>
    </div>

    <div id="menuItemBox">
      <!--Pizzas--->
      <div id="itemPizza">
	      <?php
		      $sql = "Select * from `amoray-pizza`.pizza_type";
		      $result = $conn->query($sql);
		      while ($row = $result->fetch_assoc()){
				  ?>
			      <div class="container">
				      <div class="productImg">
					      <img src="../images/products/pizza<?=$row["pizza_type_id"]?>.jpg" alt="image" class="menuItemImg">
					      <h1 class="productImgText"><?=$row["pizza_type_name"]?></h1>
				      </div><br>
				      <div class="middle">
					      <p><?=$row["pizza_description"]?></p><br>
					      <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/pizza/templatePizza.php?type=<?=$row["pizza_type_id"]?>';}, 550), foodTransition();;">Customize</button>
				      </div>
			      </div>
			      <?php
		      }
	      ?>
      </div>
      <!--Wings--->
      <div id="itemWings">
	      <?php
		      $sql = "Select * from `amoray-pizza`.items where item_category = 2";
		      $result = $conn->query($sql);
		      while ($row = $result->fetch_assoc()){
			      ?>
			      <div class="container">
				      <div class="productImg">
					      <img src="../images/products/item<?=$row["item_id"]?>.jpg" alt="image" class="menuItemImg">
					      <h1 class="productImgText"><?=$row["item_name"]?></h1>
				      </div><br>
				      <div class="middle">
					      <p>Wings.</p><br>
					      <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/wings/templateWings.php?type=<?=$row["item_id"]?>';}, 550), foodTransition();;">Customize</button></div>
			      </div>
			      <?php
		      }
	      ?>
	      
      </div>
        <!--Sides--->
        <div id="itemSides">
	        <?php
		        $sql = "Select * from `amoray-pizza`.items where item_category = 1";
		        $result = $conn->query($sql);
		        while ($row = $result->fetch_assoc()){
					?>
			        <div class="container">
				        <div class="productImg">
					        <img src="../images/products/item<?=$row["item_id"]?>.jpg" alt="image" class="menuItemImg">
					        <h1 class="productImgText"><?=$row["item_name"]?></h1>
				        </div><br>
				        <div class="middle">
					        <p>Sides</p><br>
					        <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/sides/templateSides.php?type=<?=$row["item_id"]?>';}, 550), foodTransition();;">Customize</button>
				        </div>
			        </div>
			        <?php
		        }
	        ?>
        </div>
        <!--Drinks--->
        <div id="itemDrinks">
	        <?php
	            $sql = "Select * from `amoray-pizza`.items where item_category = 3";
				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()){
					?>
					<div class="container">
						<div class="productImg">
							<img src="../images/products/item<?=$row["item_id"]?>.jpg" alt="image" class="menuItemImg">
							<h1 class="productImgText"><?=$row["item_name"]?></h1>
						</div><br>
						<div class="middle">
							<p>Drinks</p><br>
							<button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/drinks/templateDrinks.php?type=<?=$row["item_id"]?>';}, 550), foodTransition();;">Customize</button>
						</div>
					</div>
					<?php
				}
	        ?>
        </div>
        <!--More--->
        <div id="itemMore">
	        <?php
		        $sql = "Select * from `amoray-pizza`.salad_type";
		        $result = $conn->query($sql);
		        while ($row = $result->fetch_assoc()){
			        ?>
			        <div class="container">
				        <div class="productImg">
					        <img src="../images/products/salad<?=$row["salad_type_id"]?>.jpg" alt="image" class="menuItemImg">
					        <h1 class="productImgText"><?=$row["salad_type_name"]?></h1>
				        </div><br>
				        <div class="middle">
					        <p><?=$row["salad_type_desc"]?></p><br>
					        <button type="button" class="add" onclick="setTimeout(function () {location.href = 'menuItems/sides/templateSidesSalad.php?type=<?=$row["salad_type_id"]?>';}, 550), foodTransition();;">Customize</button>
				        </div>
			        </div>
			        <?php
		        }
	        ?>
      </div>
    </div>  
  <script>
    window.onscroll = function() {scrollFunction()};
    pageTransitionIn();
  </script>
    <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
  </body>
</html>