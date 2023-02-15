<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "micahtesting");
	if (isset($_COOKIE["user"])){
		header("Location: testLoggedIn.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!$conn->connect_error){
			$sql = $conn->prepare("SELECT * FROM `amoray-pizza`.customer WHERE customer_username = ? AND customer_password = ?");
			$sql->bind_param('ss', $_POST["uName"], $_POST['passW']);
			$sql->execute();
			$result = $sql->get_result();
			$row = $result->fetch_assoc();
			if ($result->num_rows > 0){
				$userId = $row["customer_id"];
				setcookie("user", "$userId", time()+(86400*30), "/");
				header("Location: testLoggedIn.php");
			}
		}
	}
?>
<html lang="en">
	<head>
		<title>FIRSTBASE!</title>
	</head>
	<body>
		<form action="test2.php" method="post">
			<label>Username:
				<input type="text" name="uName">
			</label><br><br>
			<label>Password:
				<input type="password" name="passW">
			</label><br><br>
			<input type="submit" name="Submit">
		</form>
	</body>

</html>
