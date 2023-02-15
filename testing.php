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

<html lang="en">
	<head>
		<title>ET Ph0ne H0me</title>
	</head>
	<body>
		<form action="testing.php" method="post">
			<label>
				<input type="number" name="numz">
			</label>
			<input type="submit" name="Button">
		</form>
		<br>
		<br>
		<?php
			if (!$sqlConn->connect_error){
			$sql = "SELECT * FROM `amoray-pizza`.customer left join `amoray-pizza`.state on customer_state_id = state_id;";
			$result = $sqlConn->query($sql);
			if ($result->num_rows > 0){
		?>
		<table>
			<tr style="background-color: #cccccc">
				<td>ID</td>
				<td>Name</td>
				<td>Username</td>
				<td>Address</td>
				<td>State</td>
				<td>Zip</td>
				<td>Phone</td>
			</tr>
			
			
			
			<?php
				while ($row = $result->fetch_assoc()){
					?>
					<tr style="background-color: #f2f2f2">
						<td><?=$row["customer_id"]?></td>
						<td><?=$row["customer_name"]?></td>
						<td><?=$row["customer_username"]?></td>
						<td><?=$row["customer_address"]?></td>
						<td><?=$row["state_name"]?></td>
						<td><?=$row["customer_zip"]?></td>
						<td><?=$row["customer_phoneNum"]?></td>
					</tr>
					
					
					<?php
				}
				}else{
				echo "No data :/";
			}
				}else{
				echo "Connection Failed :(";
			}
			
			?>
	</body>
</html>
