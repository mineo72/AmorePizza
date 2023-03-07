<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isValidCard($_POST["inpot"])){
			echo "Works";
		}else{
			echo "Doesn't";
		}
	}
	function isValidCard($input){
		$inArray = str_split($input);
		$total = 0;
		foreach ($inArray as $in){
			$total += intval($in)*2;
		}
		echo $total;
		if ($total%10 == 0){
			return true;
		}else{
			return false;
		}
	}
	?>
<form method="post" action="aaaa.php">
	<input type="text" name="inpot">
	<input type="submit" value="Test">
</form>