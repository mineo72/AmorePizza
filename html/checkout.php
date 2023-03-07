<?php
$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$fName = $_POST["firstname"];
		$lName = $_POST["lastname"];
		$address = $_POST["address"];
		$city = $_POST["city"];
		$stateId = $_POST["state"];
		$zip = $_POST["zip"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$ccNum = $_POST["cardNumber"];
		$exp = $_POST["cardExpiry"];
		$cvv = $_POST["cardCVV"];
		$order = $_POST["order"];
		if (isValidCard($ccNum)){
			?>
			
			<?php
		}
	}
	?>
<form id="meatball" method="post" action="confirmTransaction.php">
	<input type="hidden" name="firstname" value="<?=$fName?>">
	<input type="hidden" name="lastname" value="<?=$lName?>">
	<input type="hidden" name="address" value="<?=$address?>">
	<input type="hidden" name="city" value="<?=$city?>">
	<input type="hidden" name="state" value="<?=$stateId?>">
	<input type="hidden" name="zip" value="<?=$zip?>">
	<input type="hidden" name="email" value="<?=$email?>">
	<input type="hidden" name="phone" value="<?=$phone?>">
	<input type="hidden" name="ccNum" value="<?=$ccNum?>">
	<input type="hidden" name="exp" value="<?=$exp?>">
	<input type="hidden" name="cvv" value="<?=$cvv?>">
	<input type="hidden" name="order" value="<?=$order?>">
</form>
<?php
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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Checkout | AmorayPizza</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/nav.css" rel="stylesheet" />
    <link href="../css/transaction.css" rel="stylesheet" />
    <link href="../images/amorayLogoConcept.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../javascript/scripts.js"></script>
  </head>
  <body>
    <!--Back to top button-->
    <!--<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>-->

    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a href="index.php" class="active">Home</a></li>
        <li class="linav"><a href="menu.html">Menu</a></li>
      </ul>
    </div>      
    <center><br><br><br><br><br><span class="title">Checkout</span></center>

    <div id="pageCheckout">
      <div id="paymentDiv">
        <span class="title">Payment Info</span><br>
        <form method="POST" action="checkout.php">
          <span class="formText" id="typeInline">First Name*</span>
          <span class="formText" id="typeInline">Last Name*</span><br>
          <input type="text" name="firstname" value="" class="formInput" id="typeSmall">
          <input type="text" name="lastname" value="" class="formInput" id="typeSmall"><br>
          <span class="formText">Address*</span><br>
          <input type="text" name="address" value="" class="formInput" id="typeLarge"><br>
          <span class="formText" id="typeInline">City*</span>
          <span class="formText" id="typeInline">State*</span>
          <span class="formText" id="typeInline">Zip*</span><br>
          <input type="text" name="city" value="" class="formInput" id="typeTiny">
          <select name="state" class="formInput" id="typeTiny">
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
          </select>
          <input type="text" name="zip" value="" class="formInput" id="typeTiny"><br>

          <span class="formText">Email</span><br>
          <input type="text" name="email" value="" class="formInput" id="typeLarge"><br>
          <span class="formText">Phone</span><br>
          <input type="text" name="phone" value="" class="formInput" id="typeLarge">

          <span class="formText">Card Info*</span><br>
          <input type="text" name="cardNumber" value="" class="formInput" id="typeLarge"><br>
          <span class="formText" id="typeInline">Expiry*</span>
          <span class="formText" id="typeInline">CVV*</span><br>
          <input type="text" name="cardExpiry" value="" class="formInput" id="typeTiny">
          <input type="text" name="cardCVV" value="" class="formInput" id="typeTiny"><br>
        </div>

        <div id="orderDiv">
	        <?php
		        $priceTotal = 0;
		        if (isset($_COOKIE["cart"])){
			        $cartArray = explode(',',$_COOKIE["cart"]);
			        foreach ($cartArray as $cartItem){
				        $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
				        $result = $conn->query($sql);
				        $row = $result->fetch_assoc();
				        $priceTotal = $priceTotal+$row["item_price"];
			        }
			        ?><span>$<?=$priceTotal?></span><?php
		        }
	        ?>
          <span class="title">Order - </span><span class="title">$<?=$priceTotal?></span><br>
            <table>
	            <?php
		            $counter = 0;
		            if (isset($_COOKIE["cart"])){
			            $cartArray = explode(',',$_COOKIE["cart"]);
			            foreach ($cartArray as $cartItem){
							$counter++;
				            $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
				            $result = $conn->query($sql);
				            $row = $result->fetch_assoc();
				            ?><tr>
					            <td id="td"><?=$row["item_name"]?></td>
					            <td id="td">$<?=$row["item_price"]?></td>
					            <td><a href="actions/update.php?>" class="tnav">Edit</a> / <a href="actions/delete.php?id=<?=$counter?>" class="tnav">Delete</a></td>
				                <input type="hidden" name="order" value="<?=$_COOKIE["cart"]?>">
				            </tr>
				            <?php
			            }
		            }
	            ?>
             
            </table>

            <center>
	            <!--<br><span class="text">Promo Code:</span><br>
				<input type="text" name="promo" value="" class="formInput" id="typeLarge"><br><br>-->
	            <?php
	            if (isset($_COOKIE["cart"])){
	            ?>
                    <input type="submit" class="buttonSubmit" name="Submit" value="Submit Order">
	            <?php
	            }else{?>
		            <span style="color: #bb3e00">Your cart is empty!</span><br><br>
	            <?php
	            }
	            ?>
	            </form>
            </center>
        </div> //Hello spence!
      </div>
      <script>
        window.onscroll = function() {scrollFunction()};
      </script>
      <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
  </body>
</html>
