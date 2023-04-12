<?php
include '..\..\..\outclude.php';
if (isset($_POST["type"])){$itemType = $_POST["type"];}
	else if (isset($_GET["type"])) {$itemType = $_GET["type"];}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_COOKIE["cart"])){
			$cart = $_COOKIE["cart"];
			setcookie("cart", "$cart,$itemType", time()+(86400*30), "/");
		}else{
			setcookie("cart", "$itemType", time()+(86400*30), "/");
		}
		header("Location: templateSides.php?type=$itemType");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Drink Template | AmorayPizza</title>
	<link href="../../../css/function/styles.css" rel="stylesheet"/>
	<link href="../../../css/function/nav.css" rel="stylesheet"/>
	<link href="../../../css/food/item.css" rel="stylesheet"/>
	<link href="../../../images/amorayLogo.png" rel="icon" type="image/x-icon">
	<script type="text/javascript" src="../../../javascript/scripts.js"></script>
</head>
<body>
<!--Navigation bar-->
<div id="navbox">
	<ul id="ulnav">
		<a href="../../index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
		<button onclick="openNav()" id="openNav" class="navbutton"></button>
		<button onclick="closeNav()" id="closeNav" class="navbutton"></button>
		<li class="linav"><a href="../../index.php">Home</a></li>
		<li class="linav"><a href="../../menu.php" class="active">Menu</a></li>
		<li class="linav"><a href="../../about.php">About</a></li>
		<li class="linav"><a href="../../contact.php">Contact</a></li>
		<a href="../../account.html" id="accountImg" alt="User Account"></a>
		<div class="dropdown" id="dropdown">			
			    <button onclick="dropdownFunction()" class="dropbtn"><img src="../../../images/cart.png" class="cartImg">
				    <span id="cartText">Cart</span>
				    <?php
					    $priceTotal = 0;
					    if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])){
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
					    if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])){
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
				    <button class="checkout" onclick="location.href='../../checkout.php'" >Checkout</button>
			    </div>
		    </div>
	</ul>
</div>
<br><br><br><br><br><br>

<!--TESTING CONTENT-->

<main class="containerItm">
	<?php
		$sql = "select * from `amoray-pizza`.items where item_id = $itemType";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
	?>
	<!-- Left Column / Image -->
	<div class="left-column">
		<img src="..\..\..\images\products\item<?=$_GET["type"]?>.jpg" alt="">
	</div>
	
	<form id="survey-form" method="post" action='http://localhost:8080/html/menuitems/sides/templateSides.php?type=<?=$itemType?>'> <!--Change this to what it needs to be-->
		<!-- Right Column -->
		<div class="right-column">
			
			<!-- Product Description -->
			<div class="product-description">
				<span>Side</span><br><br>
				<h1><?=$row["item_name"]?></h1><br>
				<!-- Product Pricing -->
				<div class="product-price">
					<span>$<?=$row["item_price"]?></span>
					<!-- Submit -->
					<input id="submit" type="submit" value="Add to Cart" />
				</div>
				<br>
			</div>
			<fieldset>
				<label for="special-instructions">Special Instructions:
					<textarea id="feedback" name="feedback" rows="3" cols="30" placeholder="Add here..."></textarea>
				</label>
			</fieldset>
	</form>
	<br><br><br><br>
	</div>
</main>
</body>
</html>
