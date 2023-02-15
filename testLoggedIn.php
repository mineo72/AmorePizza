<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "micahtesting");
	if (isset($_COOKIE["user"])){
		$sql = "SELECT * FROM `amoray-pizza`.customer where customer_id = {$_COOKIE["user"]}";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo "Hello {$row["customer_name"]}";
	}else{
		echo "Not logged in";
	}
?>
<html lang="en">
	<head>
		<title>Logged In</title>
	</head>
	<body>
	<br>
		<?php
		echo "Test";
		?>
	</body>
</html>