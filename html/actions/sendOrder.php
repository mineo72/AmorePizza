<?php
$cardNum = $_POST["cardNumber"];
if(isValidCard($cardNum)){
	echo "test";
}else{
	print "wrong :<";
}
	function isValidCard($input)
	{
		$inArray = str_split($input);
		$total = 0;
		foreach ($inArray as $in) {
			$total += intval($in) * 2;
		}
		echo $total;
		if ($total % 10 == 0) {
			return true;
		} else {
			return false;
		}
	}