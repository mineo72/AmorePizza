<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");

?>
	
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Checkout | AmorayPizza</title>
		<link href="../css/styles.css" rel="stylesheet" />
		<link href="../css/nav.css" rel="stylesheet" />
		<link href="../css/transaction.css" rel="stylesheet" />
		<link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
		<link href="../images/amorayLogoConcept.png" rel="icon" type="image/x-icon">
		<script type="text/javascript" src="../javascript/scripts.js"></script>
	</head>
	<body>
	<!--Back to top button-->
	<!--<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>-->
	
	<!--Navigation bar-->
	<div id="navbox">
		<ul id="ulnav">
			<a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
			<button onclick="openNav()" id="openNav" class="navbutton"></button>
			<button onclick="closeNav()" id="closeNav" class="navbutton"></button>
			<li class="linav"><a href="index.php" class="active">Home</a></li>
			<li class="linav"><a href="menu.php">Menu</a></li>
	</div>
	</ul>
	</div>
	<center><br><br><br><br><br><span class="title">Checkout</span></center>
	
	<div id="pageCheckout">
		<div id="orderDiv">
			<span class="title">-Transaction Complete-</span>
			<br><span class="subtitle">Thank you for shopping at Amoray!</span><br><br>
			<?php
				$priceTotal = 0;
				if (isset($_COOKIE["cart"])){
					$cartArray = explode(',',$_COOKIE["cart"]);
					foreach ($cartArray as $cartItem){
						$sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$priceTotal = $priceTotal+$row["item_price"];
					}
				}
				if (isset($_COOKIE["pizzaCart"])){
					$cartArray = explode(',',$_COOKIE["pizzaCart"]);
					foreach ($cartArray as $cartItem){
						$sql = "SELECT * FROM `amoray-pizza`.pizza where pizza_id = $cartItem;";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$priceTotal = $priceTotal+$row["pizza_price"];
					}
				}
				if (isset($_COOKIE["saladCart"])){
					$cartArray = explode(',',$_COOKIE["pizzaCart"]);
					foreach ($cartArray as $cartItem){
						$sql = "SELECT * FROM `amoray-pizza`.salad where salad_id = $cartItem;";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$priceTotal = $priceTotal+$row["salad_price"];
					}
				}
			?>
			<span class="title">Order - </span><span class="title">$<?=$priceTotal?></span><br>
			<table>
				<?php
					if (isset($_COOKIE["pizzaCart"])){
						$cartArray = explode(',',$_COOKIE["pizzaCart"]);
						foreach ($cartArray as $cartItem){
							
							$sql = "SELECT * FROM `amoray-pizza`.pizza left join `amoray-pizza`.pizza_type on pizza_type_id = pizza_type where pizza_id = $cartItem;";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr>
							<td id="td"><?=$row["pizza_type_name"]?></td>
							<td id="td">$<?=$row["pizza_price"]?></td>
							<input type="hidden" name="order" value="<?=$_COOKIE["pizzaCart"]?>">
							</tr>
							<?php
						}
					}
				?>
				<?php
					if (isset($_COOKIE["saladCart"])){
						$cartArray = explode(',',$_COOKIE["saladCart"]);
						foreach ($cartArray as $cartItem){
							
							$sql = "SELECT * FROM `amoray-pizza`.salad left join `amoray-pizza`.salad_type on salad_type_id = salad_salad_type_id where salad_id = $cartItem;";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr>
							<td id="td"><?=$row["salad_type_name"]?></td>
							<td id="td">$<?=$row["salad_price"]?></td>
							<input type="hidden" name="order" value="<?=$_COOKIE["saladCart"]?>">
							</tr>
							<?php
						}
					}
				?>
				<?php
					if (isset($_COOKIE["cart"])){
						$cartArray = explode(',',$_COOKIE["cart"]);
						foreach ($cartArray as $cartItem){
							
							$sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr>
							<td id="td"><?=$row["item_name"]?></td>
							<td id="td">$<?=$row["item_price"]?></td>
							<input type="hidden" name="order" value="<?=$_COOKIE["cart"]?>">
							</tr>
							<?php
						}
					}
				?>
			</table>
			<center><button class="buttonSubmit" onclick="location.href='index.php'">Return Home</button></center>
		</div>
	</div>
	<script>
		window.onscroll = function() {scrollFunction()};
	</script>
	</body>
	</html>
<?php
	setcookie("cart", null, -1, '/');
	setcookie("pizzaCart", null, -1, '/');
	setcookie("saladCart", null, -1, '/');
?>