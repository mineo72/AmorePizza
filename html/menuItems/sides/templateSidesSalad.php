<?php
	$conn = new mysqli("10.4.52.68:3306", "micah", "olson", "amoray-pizza");
	$saladName = "Test Pizza";
	$basePrice = 12.99;
	
	if (isset($_POST["type"])){
		$saladType = $_POST["type"];
		$sql = "Select * From `amoray-pizza`.salad_type where salad_type_id = '$saladType';";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$basePrice = $row["salad_type_price"];
		$saladName = $row["salad_type_name"];
		$saladDesc = $row["salad_type_desc"];
	}else
		if (isset($_GET["type"])) {
			$saladType = $_GET["type"];
			$sql = "Select * From `amoray-pizza`.salad_type where salad_type_id = '$saladType';";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$basePrice = $row["salad_type_price"];
			$saladName = $row["salad_type_name"];
			$saladDesc = $row["salad_type_desc"];
		}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$addins = "";
		if (isset($_POST["pepperoni"])){
			$addins = $addins . "pepperoni,";
		}
		if (isset($_POST["sausage"])){
			$addins = $addins . "sausage,";
		}
		if (isset($_POST["mushrooms"])){
			$addins = $addins . "mushroom,";
		}
		if (isset($_POST["bacon"])){
			$addins = $addins . "bacon,";
		}
		if (isset($_POST["black-olives"])){
			$addins = $addins . "olive,";
		}
		if (isset($_POST["onions"])){
			$addins = $addins . "onion,";
		}
		if (isset($_POST["basil"])){
			$addins = $addins . "basil,";
		}
		if (isset($_POST["pineapple"])){
			$addins = $addins . "pApple,";
		}
		if (isset($_POST["ham"])){
			$addins = $addins . "ham,";
		}
		if (isset($_POST["banana-peppers"])){
			$addins = $addins . "baPepper,";
		}
		if (isset($_POST["meatballs"])){
			$addins = $addins . "meatball,";
		}
		if (isset($_POST["bell-peppers"])){
			$addins = $addins . "bePepper,";
		}
		if (isset($_POST["chicken"])){
			$addins = $addins . "chicken,";
		}
		$addins = trim($addins, ',');
		//echo $toppings;
		if ($addins == ""){
			$price = $basePrice;
		}else{
			$toppingList = explode(',',$addins);
			$price = $basePrice + count($toppingList);
		}
		
		//echo $price;
		$base = $_POST["base"];
		$dressing = $_POST["dressing"];
		$croutons = $_POST["croutons"];
		
		$sql = "SELECT * FROM `amoray-pizza`.salad WHERE salad_base = '$base' and salad_dressing = '$dressing' and salad_croutons = '$croutons' and salad_add_ins = '$addins';";
		$result = $conn->query($sql);
		$row = $result->num_rows;
		if ($row == 0){
			echo "Doesn't Exist";
			$sql = "Insert Into `amoray-pizza`.salad (salad_salad_type_id, salad_base, salad_dressing, salad_croutons, salad_add_ins, salad_price) VALUE ('$saladType','$base','$dressing','$croutons','$addins','$price');";
			$conn->query($sql);
			$saladItem = $conn->insert_id;
			if (isset($_COOKIE["saladCart"])){
				$cart = $_COOKIE["saladCart"];
				setcookie("saladCart", "$cart,$saladItem", time()+(86400*30), "/");
			}else{
				setcookie("saladCart", "$saladItem", time()+(86400*30), "/");
			}
		}else{
			$sql = "SELECT * FROM `amoray-pizza`.salad left join `amoray-pizza`.salad_type on salad_salad_type_id = salad_type_id WHERE salad_base = '$base' and salad_dressing = '$dressing' and salad_croutons = '$croutons' and salad_add_ins = '$addins';";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$saladItem = $row["salad_id"];
			if (isset($_COOKIE["saladCart"])){
				$cart = $_COOKIE["saladCart"];
				setcookie("saladCart", "$cart,$saladItem", time()+(86400*30), "/");
			}else{
				setcookie("saladCart", "$saladItem", time()+(86400*30), "/");
			}
			echo "Exists";
		}
		header("Location: templateSidesSalad.php?type=$saladType");
		
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Salad Template | AmorayPizza</title>
    <link href="../../../css/function/styles.css" rel="stylesheet"/>
    <link href="../../../css/function/nav.css" rel="stylesheet"/>
    <link href="../../../css/food/item.css" rel="stylesheet"/>
    <link href="../../../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../../../javascript/scripts.js"></script>
	  <script>
		  console.log("lest0");
		  function changePrice() {
			  var chk1 = document.getElementById("pepperoni");
			  var chk2 = document.getElementById("sausage");
			  var chk3 = document.getElementById("mushrooms");
			  var chk4 = document.getElementById("bacon");
			  var chk5 = document.getElementById("black-olives");
			  var chk6 = document.getElementById("onions");
			  var chk7 = document.getElementById("basil");
			  var chk8 = document.getElementById("pineapple");
			  var chk9 = document.getElementById("ham");
			  var chk10 = document.getElementById("meatballs");
			  var chk11 = document.getElementById("bell-peppers");
			  var chk12 = document.getElementById("chicken");
			  var price = <?=$basePrice?>;
			  var text = document.getElementById("price");
			  var count = 0;
			  if (chk1.checked == true){
				  price = price + 1;
			  }if (chk2.checked == true){
				  price = price + 1;
			  }if (chk3.checked == true){
				  price = price + 1;
			  }if (chk4.checked == true){
				  price = price + 1;
			  }if (chk5.checked == true){
				  price = price + 1;
			  }if (chk6.checked == true){
				  price = price + 1;
			  }if (chk7.checked == true){
				  price = price + 1;
			  }if (chk8.checked == true){
				  price = price + 1;
			  }if (chk9.checked == true){
				  price = price + 1;
			  }if (chk10.checked == true){
				  price = price + 1;
			  }if (chk11.checked == true){
				  price = price + 1;
			  }if (chk12.checked == true){
				  price = price + 1;
			  }
			  price = price + count;
			  console.log(price);
			  text.innerText = '$' + price;
		  }
	  </script>
  </head>
  <body>
    <!--Navigation bar-->
    <div id="navbox">
      <ul id="ulnav">
        <a href="../../index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a href="../../index.php">Home</a></li>
        <li class="linav"><a href="../../menu.php" class="active">Menu</a></li>
        <li class="linav"><a href="../../about.php">About</a></li>
        <li class="linav"><a href="../../contact.php">Contact</a></li>
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
			      <button class="checkout" onclick="location.href='../../checkout.php'" >Checkout</button>
		      </div>
	      </div>
      </ul>
    </div>
    <br><br><br><br><br><br>

    <!--TESTING CONTENT-->

    <main class="containerItm">
 
      <!-- Left Column / Image -->
      <div class="left-column">
        <img src="/images/products/salad<?=$_GET["type"]?>.jpg" alt="">
      </div>
     
      <form id="survey-form" method="post" action='templateSidesSalad.php?type=<?=$saladType?>'> <!--Change this to what it needs to be-->
      <!-- Right Column -->
      <div class="right-column">
     
        <!-- Product Description -->
        <div class="product-description">
          <span>Salads</span><br><br>
          <h1 id="name"><?=$saladName?></h1><br>
          <!-- Product Pricing -->
          <div class="product-price">
            <span id="price">$<?=$basePrice?></span>
            <!-- Submit -->
            <input id="submit" type="submit" value="Add to Cart" />
          </div>
          <br>
          <p id="description"><?=$saladDesc?></p>
        </div>
            <fieldset>
              <!-- Base -->
              <label>Base
                <select id="dropdown" name="base">
                  <option value="lettuce">Lettuce</option>
                  <option value="regular" selected>Regular</option>
                  <option value="spinich">Spinich</option>
                  <option value="mixed">Mixed</option>
                </select>
              </label>
              <!-- Dressing, change values -->
              <label>Dressing
                <select id="dropdown" name="dressing">
                  <option value="ranch" selected>Ranch</option>
                  <option value="caesar">Caesar</option>
                  <option value="buttermilk">Buttermilk</option>
                  <option value="elderberry">Elderberry Vinaigrette</option>
                  <option value="bleu-cheese">Bleu Cheese</option>
                  <option value="olive-oil">Olive Oil</option>
                  <option value="thousand-island">Thousand Island</option>
                  <option value="italian">Italian</option>
                  <option value="honey-mustard">Honey Mustard</option>
                  <option value="french">French</option>
                  <option value="no-dressing">None</option>
                </select>
              </label>
              <!-- Crouton -->
              <label>Croutons
                <select id="dropdown" name="croutons">
                  <option value="regular" selected>Regular</option>
                  <option value="garlic">Garlic</option>
                  <option value="herb">Herb</option>
                  <option value="parmesan">Parmesan</option>
                  <option value="no-crouton">None</option>
                </select>
              </label>
              <br>
              <!-- Attributes of product, checkboxes -->
              <p>Add Ins</p>
	            <label for="pepperoni" class="itm-topping">
		            <input id="pepperoni" type="checkbox" name="pepperoni" value="pepperoni" onclick="changePrice()">Pepperoni
	            </label>
	            <label for="sausage" class="itm-topping">
		            <input id="sausage" type="checkbox" name="sausage" value="sausage" onclick="changePrice()">Sausage
	            </label>
	            <label for="mushrooms" class="itm-topping">
		            <input id="mushrooms" type="checkbox" name="mushrooms" value="mushrooms" onclick="changePrice()">Mushrooms
	            </label>
	            <label for="bacon" class="itm-topping">
		            <input id="bacon" type="checkbox" name="bacon" value="bacon" onclick="changePrice()">Bacon
	            </label>
	            <label for="black-olives" class="itm-topping">
		            <input id="black-olives" type="checkbox" name="black-olives" value="olives" onclick="changePrice()">Black olives
	            </label>
	            <label for="onions" class="itm-topping">
		            <input id="onions" type="checkbox" name="onions" value="onions" onclick="changePrice()">Onions
	            </label>
	            <label for="basil" class="itm-topping">
		            <input id="basil" type="checkbox" name="basil" value="basil" onclick="changePrice()">Basil
	            </label>
	            <label for="pineapple" class="itm-topping">
		            <input id="pineapple" type="checkbox" name="pineapple" value="pineapple" onclick="changePrice()">Pineapple
	            </label>
	            <label for="ham" class="itm-topping">
		            <input id="ham" type="checkbox" name="ham" value="ham" onclick="changePrice()">Ham
	            </label>
	            <label for="banana-peppers" class="itm-topping">
		            <input id="banana-peppers" type="checkbox" name="banana-peppers" value="banana-peppers" onclick="changePrice()">Banana Peppers
	            </label>
	            <label for="meatballs" class="itm-topping">
		            <input id="meatballs" type="checkbox" name="meatballs" value="meatballs" onclick="changePrice()">Meatballs
	            </label>
	            <label for="bell-peppers" class="itm-topping">
		            <input id="bell-peppers" type="checkbox" name="bell-peppers" value="bell-peppers" onclick="changePrice()">Bell Peppers
	            </label>
	            <label for="chicken" class="itm-topping">
		            <input id="chicken" type="checkbox" name="chicken" value="chicken" onclick="changePrice()">Chicken
	            </label>
	            <input type="hidden" id="type" name="type" value="<?=$saladType?>">

            </fieldset>
            <fieldset>
              <!-- Additional comments, textarea -->
              <label for="special-instructions">Special Instructions:
                <textarea id="feedback" name="feedback" rows="3" cols="30" placeholder="Add here..."></textarea>
              </label>
            </fieldset>
          </form>
     
          <br><br><br><br>
      </div>
    </main>

  </body>
</html>
