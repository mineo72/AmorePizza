<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$sql = "UPDATE `amoray-pizza`.`order` SET order_finished = true WHERE order_id = {$_POST["ordId"]}";
		$result = $conn->execute_query($sql);
	}
	
	if (!$conn->connect_error){
		$sql = "SELECT * FROM `amoray-pizza`.`order` left join `amoray-pizza`.pizza on order_pizza_id = pizza_id left join `amoray-pizza`.drink on order_drink_id = drink_id left join `amoray-pizza`.side on order_side_id = side_id left join `amoray-pizza`.crusttype on pizza_crustType_id = crustType_id left join `amoray-pizza`.customer on order_customer_id = customer_id";
		$result = $conn->query($sql);
	?>
	<html lang="en">
		<head>
			<title>CookSide Orders</title>
			<style>
				table, th, td {
				border: 2px solid
				}
			</style>
		</head>
		<body>
			<?php
			while ($rows = $result->fetch_assoc()){
				if ($rows["order_finished"] == 0){
				?>
				<div>
					<table>
						<tr>
							<th>Customer</th>
							<th>Pizza</th>
							<th>Drink</th>
							<th>Side</th>
							<th>Special Instructions</th>
						</tr>
						<tr>
						<td><?=$rows["customer_name"]?></td>
						<td>Crust: <?=$rows["crustType_type"]?></td>
						<td><?=$rows["drink_name"]?></td>
						<td><?=$rows["side_name"]?></td>
						<td><?=$rows["order_specialinstructions"]?></td>
				</tr>
				<tr>
					<td></td>
					<td>Crust thickness: <?=$rows["pizza_crustThickness"]?></td>
				</tr>
				<tr>
					<td></td>
					<td>Cheese: <?=$rows["pizza_cheese"]?></td>
				</tr>
				<tr>
					<td></td>
					<td>Toppings: <?=$rows["pizza_toppings"]?></td>
				</tr>
				<tr>
					<td></td>
					<td>Sauce: <?=$rows["pizza_sauce"]?></td>
				</tr>
				<tr>
					<td></td>
					<td>Size: <?=$rows["pizza_size"]?></td>
				</tr>
				<tr>
					<td>
						<form method="post">
							<input type="hidden" value="<?=$rows["order_id"]?>" name="ordId">
							<input type="submit" name="Finish Order">
						</form>
					</td>
				</tr>
				</table>
				</div>
				<?php
				}
			}
			?>
		</body>
	</html>
<?php
	}else{
		echo "Connection Error"
		?>
		<title>Connection Error</title>
		<?php
	}
		
		?>