<?php
	$name = "";
	$id = 0;
	$sqlConn = new mysqli("10.4.52.68:3306", "micah", "olson", "micahtesting");
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!$sqlConn->connect_error){
			$sql = "SELECT * FROM micahtesting.test WHERE testId = {$_POST["numz"]}";
			$result = $sqlConn->query($sql);
			$row = $result->fetch_assoc();
			echo $row["testName"];
		}
	}
?>

<html>
	<head>
		<title>ET Ph0ne H0me</title>
	</head>
	<body>
		<form action="testing.php" method="post">
			<input type="number" name="numz">
			<input type="submit" name="Button">
		</form>
	</body>
</html>
