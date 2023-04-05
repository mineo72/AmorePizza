<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$fname = $_POST["contactFirstName"];
		$lname = $_POST["contactLastName"];
		$email = $_POST["contactEmail"];
		$comm = $_POST["contactComment"];
		$php = "Insert Into `amoray-pizza`.contact_request (contact_fname, contact_lname, contact_email, contact_comment) VALUE ('$fname', '$lname', '$email', '$comm');";
		$result = $conn->query($php);
		echo "Comment has been Sent!";
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>About | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet" />
    <link href="../css/function/nav.css" rel="stylesheet" />
    <link href="../css/function/column.css" rel="stylesheet" />
    <link href="../css/content/info.css" rel="stylesheet" />
    <link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../javascript/scripts.js"></script>
  </head>
  <style>
  </style>
   <body>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'index.php';}, 400), pageTransitionOut();;">Home</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'menu.php';}, 400), pageTransitionOut();;">Menu</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'about.php';}, 400), pageTransitionOut();;">About</a></li>
        <li class="linav"><a class="active">Contact</a></li>
	      <div class="dropdown" id="dropdown">
		
		      <button onclick="dropdownFunction()" class="dropbtn"><img src="../../../images/cart.png" class="cartImg">
			      <span id="cartText">Cart</span>
			      <?php
				      $priceTotal = 0;
				      if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])||isset($_COOKIE["saladCart"])){
					      if (isset($_COOKIE["pizzaCart"])){
						      $cartArray = explode(',',$_COOKIE["pizzaCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.pizza where pizza_id = '$cartItem'";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["pizza_price"];
						      }
					      }
					      if (isset($_COOKIE["saladCart"])){
						      $cartArray = explode(',',$_COOKIE["saladCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.salad where salad_id = $cartItem";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["salad_price"];
						      }
					      }
					      if (isset($_COOKIE["cart"])){
						      $cartArray = explode(',',$_COOKIE["cart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.items where item_id = $cartItem;";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      $priceTotal = $priceTotal+$row["item_price"];
						      }
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
				      if (isset($_COOKIE["cart"])|| isset($_COOKIE["pizzaCart"])||isset($_COOKIE["saladCart"])){
					      if (isset($_COOKIE["pizzaCart"])){
						      $cartArray = explode(',',$_COOKIE["pizzaCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.pizza LEFT JOIN `amoray-pizza`.pizza_type on pizza_type_id = pizza_type where pizza_id = '$cartItem';";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      ?>
							      <a href="#Test_item"><?=$row["pizza_type_name"]?>   $<?=$row["pizza_price"]?></a>
							      <?php
						      }
					      }
					      if (isset($_COOKIE["saladCart"])){
						      $cartArray = explode(',',$_COOKIE["saladCart"]);
						      foreach ($cartArray as $cartItem){
							      $sql = "SELECT * FROM `amoray-pizza`.salad LEFT JOIN `amoray-pizza`.salad_type on salad_type_id= salad_id where salad_id = '$cartItem';";
							      $result = $conn->query($sql);
							      $row = $result->fetch_assoc();
							      ?>
							      <a href="#Test_item"><?=$row["salad_type_name"]?>   $<?=$row["salad_price"]?></a>
							      <?php
						      }
					      }
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
				      }
			      ?>
			      <button class="checkout" onclick="location.href='checkout.php'" >Checkout</button>
		      </div>
	      </div>
      </ul>
    </div>

    <div id="content">
    <br><div class="divider">
      <span class="title">Our Information</span>
    </div>
    
    <div id="infoContainer">
      <table>
        <tr>
          <td class="icon"><img src="https://img.icons8.com/fluency/256/mail.png" class="imageTypeIcon"/></td>
          <td class="subtitle">amoraypizza@gmail.com</td>
        </tr>
        <tr>
          <td class="icon"><img src="https://img.icons8.com/fluency/256/ringer-volume.png" class="imageTypeIcon"/></td>
          <td class="subtitle">614-915-7063</td>
        </tr>
        <tr>
          <td class="icon"><img src="https://img.icons8.com/fluency/256/address.png" class="imageTypeIcon"/></td>
          <td class="subtitle">4565 Columbus Pike<br>Delaware, OH 43015</td>
        </tr>
      </table>
      <div id="socials">
        <table>
          <tr>
            <td><img src="https://img.icons8.com/fluency/256/facebook-new.png" class="imageTypeSocials" onclick="window.open('https://www.facebook.com')"/></td>
            <td><img src="https://img.icons8.com/fluency/256/twitter.png" class="imageTypeSocials" onclick="window.open('https://www.twitter.com')"/></td>
            <td><img src="https://img.icons8.com/fluency/256/instagram-new.png" class="imageTypeSocials" onclick="window.open('https://www.instagram.com')"/></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="divider">
      <span class="title">Contact Us</span>
    </div>
    

    
    <div id="columnContainer">
      <form method="POST" action="contact.php">
        <div id="columnLeft">
          <table>
            <tr>
              <td><span class="formText typeInline">First Name*</span></td>
              <td><input type="text" name="contactFirstName" value="" class="formInput typeMedium"></td>
            <tr>
              <td><span class="formText typeInline">Last Name*</span></td>
              <td><input type="text" name="contactLastName" value="" class="formInput typeMedium"></td>
            </tr>
            <tr>
              <td><span class="formText typeInline">Email*</span></td>
              <td><input type="text" name="contactEmail" value="" class="formInput typeMedium"></td>
           </tr>
          </table>
        </div>
     <div id="columnRight">
        <span class="formText">Comment*</span>
        <textarea type="text" name="contactComment" value="" class="formInput typeMegaMarge"></textarea><br>
    </div>
      <center>
        <button class="buttonSubmit" name="Submit" onclick="location.href='confirmTransaction.html'">Submit</button>
        </center>
    </div>
  </form>

      <script>
        window.onscroll = function() {scrollFunction()};
        pageTransitionIn();
      </script>
      <button onclick="topFunction()" id="buttonTop" title="Go to top">Top</button>
    </div>
  </body>
</html>
