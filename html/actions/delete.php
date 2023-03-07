<?php
	$nya = $_GET["id"];
echo $nya . " Test ";
if (isset($_COOKIE["cart"])){
	if (strlen( $_COOKIE["cart"]) == 1){
		setcookie("cart", null, -1, '/');
		header("Location: /html/checkout.php");
		return;
	}
	$text = $_COOKIE["cart"];
	$textArray = explode(',', $_COOKIE["cart"]);
	unset($textArray[$nya-1]);
	$newText = "";
	foreach ($textArray as $ee){
		$newText = $newText . $ee .',' ;
	}
	$newText = rtrim($newText,',');
	setcookie("cart", "$newText", time()+(86400*30), "/");
	header("Location: /html/checkout.php");
}

