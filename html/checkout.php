<?php
include '..\outclude.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$fName = $_POST["firstname"];
		$lName = $_POST["lastname"];
		$address = $_POST["address"];
		$city = $_POST["city"];
		$stateId = $_POST["state"];
		$zip = $_POST["zip"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$ccNum = $_POST["cardNumber"];
		$exp = $_POST["cardExpiry"];
		$cvv = $_POST["cardCVV"];
		echo "test1";
		if (isset($_COOKIE["pizzaCart"])){
			$pizzaOrd = $_POST["pizzaOrder"];
			echo "test2";
		}
		else{
			$pizzaOrd = "";
			
		}
		if (isset($_COOKIE["saladCart"])){
			$saladOrd = $_COOKIE["saladCart"];
			echo "test8";
		}
		else{
			$saladOrd = "";
			
		}
		if (isset($_COOKIE["cart"])){
			$otherOrder = $_POST["otherOrder"];
			echo "test3";
			
		}else{
			$otherOrder = "";
			echo "test4";
			
		}
		if (isValidCard($ccNum)){
			echo "test5";
			$sql = "Select * from `amoray-pizza`.payment_card where card_number = $ccNum";
			$result = $conn->query($sql);
			if ($result->num_rows == 0){
				$sql = "insert into `amoray-pizza`.payment_card (card_number, card_expiry_date, card_cvv) VALUE ($ccNum,'$exp',$cvv);";
				$result = $conn->query($sql);
				$cardId = $conn->insert_id;
			}else{
				$sql = "Select * from `amoray-pizza`.payment_card where card_number = $ccNum";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$cardId = $row["card_id"];
			}
			
			
			$sql = "insert Into `amoray-pizza`.`order` (order_first_name, order_last_name, order_address, order_city, order_state_id, order_zip, order_email, order_phone, order_card_id, order_items, order_pizza_items, order_salad_items) VALUE ('$fName', '$lName','$address', '$city', $stateId, $zip, '$email', '$phone', $cardId, '$otherOrder', '$pizzaOrd', '$saladOrd');";
			$result = $conn->query($sql);
			header("Location: confirmTransaction.php");
		}
	}
?>
<?php
	function isValidCard($input){
		if ($input = !0){
			$inArray = str_split($input);
			$total = 0;
			foreach ($inArray as $in){
				$total += intval($in)*2;
			}
			echo $total;
			if ($total%10 == 0){
				return true;
			}else{
				return true;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Checkout | AmorayPizza</title>
	<link href="../css/function/styles.css" rel="stylesheet" />
	<link href="../css/function/nav.css" rel="stylesheet" />
	<link href="../css/function/column.css" rel="stylesheet" />
	<link href="../css/food/transaction.css" rel="stylesheet" />
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
		<li class="linav"><a onclick="setTimeout(function () {location.href = 'index.php';}, 300), pageTransitionOut();;">Home</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'menu.php';}, 300), pageTransitionOut();;">Menu</a></li>
	</ul>
</div>
<center><br><br><br><br><br><span class="title">Checkout</span></center>

<div id="content">
	<div id="columnContainer">
		<div id="columnLeft">
			<span class="title">Payment Info</span><br>
			<form method="POST" action="checkout.php">
				<table class="tablePayment">
					<tr class="trPayment">
						<td><span class="formText">First Name*</span></td>
						<td><span class="formText">Last Name*</span></td>
					</tr>
					<tr>
						<td><input type="text" name="firstname" value="" class="formInput typeMedium"></td>
						<td class="tdSpacing"><input type="text" name="lastname" value="" class="formInput typeMedium"></td>
					</tr>
					<tr>
						<td><span class="formText">Address*</span></td>
					</tr>
					<tr>
						<td><input type="text" name="address" value="" class="formInput typeLarge"></td>
					<tr>
						<td><span class="formText" class="typeInline">City*</span></td>
						<td><span class="formText" class="typeInline">State*</span></td>
						<td><span class="formText" class="typeInline">Zip*</span></td>
					</tr>
					<tr>
						<td><input type="text" name="city" value="" class="formInput typeTiny"></td>
						<td><select name="state" class="formInput typeMediu">
							<option value="1">Alabama</option>
							<option value="2">Alaska</option>
							<option value="3">Arizona</option>
							<option value="4">Arkansas</option>
							<option value="5">California</option>
							<option value="6">Colorado</option>
							<option value="7">Connecticut</option>
							<option value="8">Delaware</option>
							<option value="9">Florida</option>
							<option value="10">Georgia</option>
							<option value="11">Hawaii</option>
							<option value="12">Idaho</option>
							<option value="13">Illinois</option>
							<option value="14">Indiana</option>
							<option value="15">Iowa</option>
							<option value="16">Kansas</option>
							<option value="17">Kentucky</option>
							<option value="18">Louisiana</option>
							<option value="19">Maine</option>
							<option value="20">Maryland</option>
							<option value="21">Massachusetts</option>
							<option value="22">Michigan</option>
							<option value="23">Minnesota</option>
							<option value="24">Mississippi</option>
							<option value="25">Missouri</option>
							<option value="26">Montana</option>
							<option value="27">Nebraska</option>
							<option value="28">Nevada</option>
							<option value="29">New Hampshire</option>
							<option value="30">New Jersey</option>
							<option value="31">New Mexico</option>
							<option value="32">New York</option>
							<option value="33">North Carolina</option>
							<option value="34">North Dakota</option>
							<option value="35">Ohio</option>
							<option value="36">Oklahoma</option>
							<option value="37">Oregon</option>
							<option value="38">Pennsylvania</option>
							<option value="39">Rhode Island</option>
							<option value="40">South Carolina</option>
							<option value="41">South Dakota</option>
							<option value="42">Tennessee</option>
							<option value="43">Texas</option>
							<option value="44">Utah</option>
							<option value="45">Vermont</option>
							<option value="46">Virginia</option>
							<option value="47">Washington</option>
							<option value="48">West Virginia</option>
							<option value="49">Wisconsin</option>
							<option value="50">Wyoming</option>
						</select>
						<td><input type="text" name="zip" value="" class="formInput typeTiny"></td>
					</tr>
						<td><span class="formText">Email</span></td>
						<td><span class="formText">Phone</span></td>
					<tr>
						<td><input type="text" name="email" value="" class="formInput typeMedium"></td>
						<td><input type="text" name="phone" value="" class="formInput typeMedium"></td>
					</tr>
					<tr>
						<td><span class="formText">Card Info*</span></td>
					</tr>
					<tr>
						<td><input type="text" name="cardNumber" value="" class="formInput typeLarge"></td>
					</tr>
					<tr>
						<td><span class="formText">Expiry*</span></td>
						<td><span class="formText">CVV*</span></td>
					</tr>
					<tr>
						<td><input type="text" name="cardExpiry" value="" class="formInput typeTiny" class="typeTiny"></td>
						<td><input type="text" name="cardCVV" value="" class="formInput typeTiny" class="typeTiny"></td>
					</tr>
					<tr>
					</tr>
					<tr>
					</tr>
				<?php
					if (isset($_COOKIE["pizzaCart"])){
						?>
						<input type="hidden" name="pizzaOrder" value="<?=$_COOKIE["pizzaCart"]?>">
						
						<?php
					}
					if (isset($_COOKIE["cart"])){
						?>
						<input type="hidden" name="otherOrder" value="<?=$_COOKIE["cart"]?>">
						<?php
					}
				?>
					</tr>
			</table>
		</div>
		
		
		<div id="columnRight">
			<?php
				$priceTotal = 0;
				if (isset($_COOKIE["pizzaCart"])){
					$cartArray = explode(',',$_COOKIE["pizzaCart"]);
					foreach ($cartArray as $cartItem){
						$sql = "SELECT * FROM `amoray-pizza`.pizza where pizza_id = '$cartItem';";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$priceTotal = $priceTotal+$row["pizza_price"];
					}
				}
				if (isset($_COOKIE["saladCart"])){
					$cartArray = explode(',',$_COOKIE["saladCart"]);
					foreach ($cartArray as $cartItem){
						$sql = "SELECT * FROM `amoray-pizza`.salad where salad_id = '$cartItem';";
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
			
			?>
			<span class="title">Order - </span><span class="title">$<?=$priceTotal?></span><br>
			<table class="tableItems">
				<?php
					$counter = 0;
					if (isset($_COOKIE["pizzaCart"])){
						$cartArray = explode(',',$_COOKIE["pizzaCart"]);
						foreach ($cartArray as $cartItem){
							$counter++;
							$sql = "SELECT * FROM `amoray-pizza`.pizza left join `amoray-pizza`.pizza_type on pizza_type_id=pizza_type where pizza_id = '$cartItem';";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr>
							<td class="tdItems"><?=$row["pizza_type_name"]?></td>
							<td class="tdItems">$<?=$row["pizza_price"]?></td>
							<td class="tdItems"><a href="actions/delete.php?type=1&id=<?=$counter?>" class="tnav">Delete</a></td>
							<input type="hidden" name="order" value="<?=$_COOKIE["pizzaCart"]?>">
							</tr>
							<?php
						}
					}
					if (isset($_COOKIE["saladCart"])){
						$cartArray = explode(',',$_COOKIE["saladCart"]);
						foreach ($cartArray as $cartItem){
							$counter++;
							$sql = "SELECT * FROM `amoray-pizza`.salad left join `amoray-pizza`.salad_type on salad_type_id = salad_salad_type_id where salad_id = '$cartItem';";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr class="trItems">
							<td class="tdItems"><?=$row["salad_type_name"]?></td>
							<td class="tdItems">$<?=$row["salad_price"]?></td>
							<td class="tdItems"><a href="actions/delete.php?type=2&id=<?=$counter?>" class="tnav">Delete</a></td>
							<input type="hidden" name="order" value="<?=$_COOKIE["saladCart"]?>">
							</tr>
							<?php
						}
					}
					if (isset($_COOKIE["cart"])){
						$cartArray = explode(',',$_COOKIE["cart"]);
						foreach ($cartArray as $cartItem){
							$counter++;
							$sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?><tr class="trItems">
							<td class="tdItems"><?=$row["item_name"]?></td>
							<td class="tdItems">$<?=$row["item_price"]?></td>
							<td class="tdItems"><a href="actions/delete.php?id=<?=$counter?>" class="tnav">Delete</a></td>
							</tr>
							<?php
						}
					}
				?>
			
			</table>
			
			<center>
				<!--<br><span class="text">Promo Code:</span><br>
				<input type="text" name="promo" value="" class="formInput" id="typeLarge"><br><br>-->
				<?php
					if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])){
						?>
						<input type="submit" class="buttonSubmit" name="Submit" value="Submit Order">
						<?php
					}else{?>
						<span style="color: #bb3e00">Your cart is empty!</span><br><br>
						<?php
					}
				?>
				</form>
			</center>
		</div>
	</div>
</div>
<script>
	window.onscroll = function() {scrollFunction()};
	pageTransitionInAlternate();
</script>
<button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
</body>
</html>