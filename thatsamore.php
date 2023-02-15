<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "micahtesting");
	echo "Sign Up?";
	if (isset($_COOKIE["user"])){
		header("Location: testLoggedIn.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (preg_match('/^[0-9]{5}(-[0-9]{4})?$/', $_POST["zip"]) && emptyCheck() && !$conn->connect_error){
			$sql = $conn->prepare("SELECT * FROM `amoray-pizza`.customer where customer_username = ?");
			$sql->bind_param('s', $_POST["userName"]);
			$sql->execute();
			$result = $sql->get_result();
			if ($result->num_rows == 0){
			$sql = "";
			$sql = $conn->prepare("INSERT INTO `amoray-pizza`.customer(customer_name, customer_username, customer_password, customer_address, customer_city, customer_state_id, customer_zip, customer_phoneNum) VALUES (?,?,?,?,?,?,?,?);");
			$sql->bind_param("sssssiss", $_POST["name"], $_POST["userName"], $_POST["passWord"], $_POST["address"], $_POST["city"], $_POST["state"], $_POST["zip"], $_POST["phone"]);
			$sql->execute();
				$sql = $conn->prepare("SELECT * FROM `amoray-pizza`.customer where customer_username = ?");
				$sql->bind_param('s', $_POST["userName"]);
				$sql->execute();
				$result = $sql->get_result();
				$row = $result->fetch_assoc();
				setcookie("user", "{$row["customer_id"]}", time()+(86400*30), "/");
				header("Location: testLoggedIn.php");
			}else{
				echo "username already taken";
			}
		}else{
			echo "One or more fields are empty!!";
		}
	}
	function emptyCheck(){
		if (empty($_POST["name"]) || empty($_POST["userName"])||empty($_POST["passWord"])|| empty($_POST["address"])||empty($_POST["city"])|| empty($_POST["phone"])){
			return false;
		}else{
			return true;
		}
	}
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Naples!</title>
	</head>
	<body>
		<form action="thatsamore.php" method="post">
			<label>Name
				<input type="text" name="name">
			</label><br>
			<label>Username
				<input type="text" name="userName">
			</label><br>
			<label>Password
				<input type="text" name="passWord">
			</label><br>
			<label>Address
				<input type="text" name="address">
			</label><br>
			<label> City
				<input type="text" name="city">
			</label><br>
			<label for="state">State</label><select name="state" id="state">
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
			</select><br>
			<label>Zip Code
				<input type="text" name="zip">
			</label><br>
			<label>Phone #
				<input type="tel" name="phone">
			</label><br>
			<input type="submit" name="Submit">
		</form>
	</body>
</html>
