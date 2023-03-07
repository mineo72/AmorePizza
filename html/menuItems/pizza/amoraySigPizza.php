<?php
$itemId = "1";
$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (isset($_COOKIE["cart"])){
			$cart = $_COOKIE["cart"];
			setcookie("cart", "$cart,$itemId", time()+(86400*30), "/");
		}else{
			setcookie("cart", "$itemId", time()+(86400*30), "/");
		}
		header("Location: /html/menuItems/pizza/amoraySigPizza.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Amoray Signature Pizza | AmorayPizza</title>
    <link href="../../../css/styles.css" rel="stylesheet" />
    <link href="../../../css/nav.css" rel="stylesheet" />
    <link href="../../../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../../../javascript/scripts.js"></script>
  </head>
  <body>
    <!--Back to top button-->
    <!--<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>-->

    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="../../index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a href="../../index.php">Home</a></li>
        <li class="linav"><a href="../../menu.html" class="active">Menu</a></li>
        <li class="linav"><a href="../../about.html">About</a></li>
        <li class="linav"><a href="../../contact.html">Contact</a></li>
        <a href="../../account.html" id="accountImg" alt="User Account"></a>
          <div class="dropdown" id="dropdown">
	          
              <button onclick="dropdownFunction()" class="dropbtn"><img src="../../../images/cart.png" class="cartImg">
              <span id="cartText">Cart</span>
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
		              }else{
			              echo "$0.00";
		              }
	              ?>
              </button>
            <!--add code to change the price to the current cart price-->
            <div id="myDropdown" class="dropdown-content">
              <!--Add code here to make an <a> tag for each item added to the cart. Replace the items below. Each item should have an id and link to their product page when clicked-->
              <!--There shouldn't be anything in the cart if the user hasn't ordered anything yet. The cart should retain information about the users purchase if they close the site (cookies?)-->
              <!--Content should scroll when more than 4 items are in the cart-->
              <!--When hovered, desc. of item is shown. When not hovered, only the name and price are shown-->
	            <?php
		            if (isset($_COOKIE["cart"])){
			            $cartArray = explode(',',$_COOKIE["cart"]);
						foreach ($cartArray as $cartItem){
							$sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();
							?>
							<a href="#Test_item"><?=$row["item_name"]?>   $<?=$row["item_price"]?></a>
							<?php
						}
		            }
	            ?>
              <button class="checkout" onclick="location.href='../../checkout.php'" >Checkout</button>
          </div> 
        </div>
      </ul>
    </div>
  
  <br><br><br><br><div style="color: #2b0d02">Test</div>
  <form action="amoraySigPizza.php" method="post">
	  <input type="submit" name="add" value="Add To Cart?" class="addToCart">
  </form>
    <div style="color: #2b0d02"><?=$_COOKIE["cart"]?></div>
  </body>
</html>
