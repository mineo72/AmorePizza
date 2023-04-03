<?php
	$nya = $_GET["id"];
	echo $nya . " Test ";
	if (isset($_GET["type"])){
		if ($_GET["type"] == 1) {
			if (strlen($_COOKIE["pizzaCart"]) == 1) {
				setcookie("pizzaCart", null, -1, '/');
				header("Location: /html/checkout.php");
				return;
			}
			$text = $_COOKIE["pizzaCart"];
			$textArray = explode(',', $_COOKIE["pizzaCart"]);
			unset($textArray[$nya - 1]);
			$newText = "";
			foreach ($textArray as $ee) {
				$newText = $newText . $ee . ',';
			}
			$newText = rtrim($newText, ',');
			setcookie("pizzaCart", "$newText", time() + (86400 * 30), "/");
			header("Location: /html/checkout.php");
		}else{
			if (strlen($_COOKIE["saladCart"]) == 1) {
				setcookie("saladCart", null, -1, '/');
				header("Location: /html/checkout.php");
				return;
			}
			$text = $_COOKIE["saladCart"];
			$textArray = explode(',', $_COOKIE["saladCart"]);
			unset($textArray[$nya - 1]);
			$newText = "";
			foreach ($textArray as $ee) {
				$newText = $newText . $ee . ',';
			}
			$newText = rtrim($newText, ',');
			setcookie("saladCart", "$newText", time() + (86400 * 30), "/");
			header("Location: /html/checkout.php");
		}
	}
	else {
		if (isset($_COOKIE["cart"])) {
			if (strlen($_COOKIE["cart"]) == 1) {
				setcookie("cart", null, -1, '/');
				header("Location: /html/checkout.php");
				return;
			}
			$text = $_COOKIE["cart"];
			$textArray = explode(',', $_COOKIE["cart"]);
			unset($textArray[$nya - 1]);
			$newText = "";
			foreach ($textArray as $ee) {
				$newText = $newText . $ee . ',';
			}
			$newText = rtrim($newText, ',');
			setcookie("cart", "$newText", time() + (86400 * 30), "/");
			header("Location: /html/checkout.php");
		}
	}