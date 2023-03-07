<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");

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
        </div>
      </ul>
    </div>
    <center><br><br><br><br><br><span class="title">Checkout</span></center>
      
    <div id="pageCheckout">
        <div id="orderDiv">
          <span class="title">-Transaction Complete-</span>
          <br><span class="subtitle">Thank you for shopping at Amoray!</span><br><br>
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
		            if (isset($_COOKIE["cart"])){
			            $cartArray = explode(',',$_COOKIE["cart"]);
			            foreach ($cartArray as $cartItem){
				
				            $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
				            $result = $conn->query($sql);
				            $row = $result->fetch_assoc();
				            ?><tr>
				            <td id="td"><?=$row["item_name"]?></td>
				            <td id="td">$<?=$row["item_price"]?></td>
				            <input type="hidden" name="order" value="<?=$_COOKIE["cart"]?>">
				            </tr>
				            <?php
			            }
		            }
	            ?>
            </table>
            <center><button class="buttonSubmit" onclick="location.href='index.html'">Return Home</button></center>
        </div>
      </div>
      <script>
        window.onscroll = function() {scrollFunction()};
      </script>
  </body>
</html>
