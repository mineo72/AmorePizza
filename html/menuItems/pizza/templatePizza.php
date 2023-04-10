<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
	$pizzaName = "";
	$basePrice = 0;
	
	if (isset($_POST["type"])){
		$pizzaType = $_POST["type"];
		$sql = "Select * From `amoray-pizza`.pizza_type where pizza_type_id = '$pizzaType';";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$basePrice = $row["pizza_type_base_price"];
		$pizzaName = $row["pizza_type_name"];
		$pizzaDesc = $row["pizza_description"];
	}else
	if (isset($_GET["type"])) {
		$pizzaType = $_GET["type"];
		$sql = "Select * From `amoray-pizza`.pizza_type where pizza_type_id = '$pizzaType';";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$basePrice = $row["pizza_type_base_price"];
		$pizzaName = $row["pizza_type_name"];
		$pizzaDesc = $row["pizza_description"];
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$toppings = "";
		if (isset($_POST["pepperoni"])){
			$toppings = $toppings . "pepperoni,";
		}
		if (isset($_POST["sausage"])){
			$toppings = $toppings . "sausage,";
		}
		if (isset($_POST["mushrooms"])){
			$toppings = $toppings . "mushroom,";
		}
		if (isset($_POST["bacon"])){
			$toppings = $toppings . "bacon,";
		}
		if (isset($_POST["black-olives"])){
			$toppings = $toppings . "olive,";
		}
		if (isset($_POST["onions"])){
			$toppings = $toppings . "onion,";
		}
		if (isset($_POST["basil"])){
			$toppings = $toppings . "basil,";
		}
		if (isset($_POST["pineapple"])){
			$toppings = $toppings . "pApple,";
		}
		if (isset($_POST["ham"])){
			$toppings = $toppings . "ham,";
		}
		if (isset($_POST["banana-peppers"])){
			$toppings = $toppings . "baPepper,";
		}
		if (isset($_POST["meatballs"])){
			$toppings = $toppings . "meatball,";
		}
		if (isset($_POST["bell-peppers"])){
			$toppings = $toppings . "bePepper,";
		}
		if (isset($_POST["chicken"])){
			$toppings = $toppings . "chicken,";
		}
		$toppings = trim($toppings, ',');
		//echo $toppings;
		if ($toppings == ""){
			$price = $basePrice;
		}else{
			$toppingList = explode(',',$toppings);
			$price = $basePrice + count($toppingList);
		}
		
		//echo $price;
		$cheese = $_POST["cheese"];
		$crust = $_POST["crust"];
		$sause = $_POST["sause"];
		
		$sql = "SELECT * FROM `amoray-pizza`.pizza WHERE pizza_cheese = '$cheese' and pizza_crust = '$crust' and pizza_sause = '$sause' and pizza_toppings = '$toppings' and pizza_type = $pizzaType;";
		$result = $conn->query($sql);
		$row = $result->num_rows;
		if ($row == 0){
			echo "Doesn't Exist";
			$sql = "Insert Into `amoray-pizza`.pizza (pizza_type, pizza_crust, pizza_sause, pizza_cheese, pizza_toppings, pizza_price) VALUE ('$pizzaType','$crust','$sause','$cheese','$toppings','$price');";
			$conn->query($sql);
			$pizzaItem = $conn->insert_id;
			if (isset($_COOKIE["pizzaCart"])){
				$cart = $_COOKIE["pizzaCart"];
				setcookie("pizzaCart", "$cart,$pizzaItem", time()+(86400*30), "/");
			}else{
				setcookie("pizzaCart", "$pizzaItem", time()+(86400*30), "/");
			}
		}else{
			$sql = "SELECT * FROM `amoray-pizza`.pizza left join `amoray-pizza`.pizza_type on pizza_type_id = pizza_type WHERE pizza_cheese = '$cheese' and pizza_crust = '$crust' and pizza_sause = '$sause' and pizza_toppings = '$toppings' and pizza_type = $pizzaType;";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$pizzaItem = $row["pizza_id"];
		if (isset($_COOKIE["pizzaCart"])){
			$cart = $_COOKIE["pizzaCart"];
			setcookie("pizzaCart", "$cart,$pizzaItem", time()+(86400*30), "/");
		}else{
			setcookie("pizzaCart", "$pizzaItem", time()+(86400*30), "/");
		}
		echo "Exists";
		}
	header("Location: templatePizza.php?type=$pizzaType");
	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Pizza Template | AmorayPizza</title>
	<link href="../../../css/function/styles.css" rel="stylesheet" />
	<link href="../../../css/function/nav.css" rel="stylesheet" />
	<link href="../../../css/food/item.css" rel="stylesheet" />
	<link href="../../../images/amorayLogo.png" rel="icon" type="image/x-icon">
	<script type="text/javascript" src="../../../javascript/scripts.js"></script>
	<script>
		console.log("lest0");
		function changePrice() {
			var chk1 = document.getElementById("pepperoni");
			var chk2 = document.getElementById("sausage");
			var chk3 = document.getElementById("mushrooms");
			var chk4 = document.getElementById("bacon");
			var chk5 = document.getElementById("black-olives");
			var chk6 = document.getElementById("onions");
			var chk7 = document.getElementById("basil");
			var chk8 = document.getElementById("pineapple");
			var chk9 = document.getElementById("ham");
			var chk10 = document.getElementById("meatballs");
			var chk11 = document.getElementById("bell-peppers");
			var chk12 = document.getElementById("chicken");
			var price = <?=$basePrice?>;
			var text = document.getElementById("price");
			var count = 0;
			if (chk1.checked == true){
				price = price + 1;
			}if (chk2.checked == true){
				price = price + 1;
			}if (chk3.checked == true){
				price = price + 1;
			}if (chk4.checked == true){
				price = price + 1;
			}if (chk5.checked == true){
				price = price + 1;
			}if (chk6.checked == true){
				price = price + 1;
			}if (chk7.checked == true){
				price = price + 1;
			}if (chk8.checked == true){
				price = price + 1;
			}if (chk9.checked == true){
				price = price + 1;
			}if (chk10.checked == true){
				price = price + 1;
			}if (chk11.checked == true){
				price = price + 1;
			}if (chk12.checked == true){
				price = price + 1;
			}
			price = price + count;
			console.log(price);
			text.innerText = '$' + price;
		}
	</script>
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
	
	<!-- Left Column / Image -->
	<div class="left-column">
		<img src="..\..\..\images\products\pizza<?=$_GET["type"]?>.jpg" alt="">
	</div>
	
	<form id="survey-form" method="post" action='templatePizza.php?type=<?=$pizzaType?>'> <!--Change this to what it needs to be-->
		<!-- Right Column -->
		<div class="right-column">
			
			<!-- Product Description -->
			<div class="product-description">
				<span>Pizza</span><br><br>
				<h1 id="name"><?=$pizzaName?></h1><br>
				<!-- Product Pricing -->
				<div class="product-price">
					<span id="price">$<?=$basePrice?></span>
					<!-- Submit -->
					<input id="submit" type="submit" value="Add to Cart" />
				</div>
				<br>
				<p id="description"><?=$pizzaDesc?></p>
			</div>
			
			
			<!-- Contact Info -->
			<!-- Questions -->
			<fieldset>
				<!-- Crust -->
				<label>Crust
					<select id="dropdown" name="crust">
						<option value="thin">Thin</option>
						<option value="regular" selected>Regular</option>
						<option value="thick">Thick</option>
						<option value="deep-dish">Deep Dish</option>
						<option value="cauliflower">Cauliflower</option>
					</select>
				</label>
				<!-- Sauce -->
				<label>Sauce
					<select id="dropdown" name="sause">
						<option value="marinara" selected>Marinara</option>
						<option value="buffalo">Buffalo</option>
						<option value="bbq">BBQ</option>
						<option value="garlic-ranch">Garlic Ranch</option>
						<option value="pesto">Pesto</option>
						<option value="no-sauce">None</option>
					</select>
				</label>
				<!-- Cheese -->
				<label>Cheese
					<select id="dropdown" name="cheese">
						<option value="mozzerella" selected>Mozzerella</option>
						<option value="provolone">Provolone</option>
						<option value="3-cheese">3 Cheese Blend</option>
						<option value="parmesan">Parmesan</option>
						<option value="no-cheese">None</option>
					</select>
				</label>
				<br>
				<!-- Attributes of product, checkboxes -->
				<p>Toppings</p>
				<label for="pepperoni" class="itm-topping">
					<input id="pepperoni" type="checkbox" name="pepperoni" value="pepperoni" onclick="changePrice()">Pepperoni
				</label>
				<label for="sausage" class="itm-topping">
					<input id="sausage" type="checkbox" name="sausage" value="sausage" onclick="changePrice()">Sausage
				</label>
				<label for="mushrooms" class="itm-topping">
					<input id="mushrooms" type="checkbox" name="mushrooms" value="mushrooms" onclick="changePrice()">Mushrooms
				</label>
				<label for="bacon" class="itm-topping">
					<input id="bacon" type="checkbox" name="bacon" value="bacon" onclick="changePrice()">Bacon
				</label>
				<label for="black-olives" class="itm-topping">
					<input id="black-olives" type="checkbox" name="black-olives" value="olives" onclick="changePrice()">Black olives
				</label>
				<label for="onions" class="itm-topping">
					<input id="onions" type="checkbox" name="onions" value="onions" onclick="changePrice()">Onions
				</label>
				<label for="basil" class="itm-topping">
					<input id="basil" type="checkbox" name="basil" value="basil" onclick="changePrice()">Basil
				</label>
				<label for="pineapple" class="itm-topping">
					<input id="pineapple" type="checkbox" name="pineapple" value="pineapple" onclick="changePrice()">Pineapple
				</label>
				<label for="ham" class="itm-topping">
					<input id="ham" type="checkbox" name="ham" value="ham" onclick="changePrice()">Ham
				</label>
				<label for="banana-peppers" class="itm-topping">
					<input id="banana-peppers" type="checkbox" name="banana-peppers" value="banana-peppers" onclick="changePrice()">Banana Peppers
				</label>
				<label for="meatballs" class="itm-topping">
					<input id="meatballs" type="checkbox" name="meatballs" value="meatballs" onclick="changePrice()">Meatballs
				</label>
				<label for="bell-peppers" class="itm-topping">
					<input id="bell-peppers" type="checkbox" name="bell-peppers" value="bell-peppers" onclick="changePrice()">Bell Peppers
				</label>
				<label for="chicken" class="itm-topping">
					<input id="chicken" type="checkbox" name="chicken" value="chicken" onclick="changePrice()">Chicken
				</label>
				<input type="hidden" id="type" name="type" value="<?=$pizzaType?>">
			
			</fieldset>
			<fieldset>
				<!-- Additional comments, textarea -->
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