<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Checkout | AmorayPizza</title>
    <link href="../css/function/styles.css" rel="stylesheet" />
    <link href="../css/function/nav.css" rel="stylesheet" />
    <link href="../css/food/transaction.css" rel="stylesheet" />
    <link href="../css/content/settings.css" rel="stylesheet" />
    <link href="../images/amorayLogo.png" rel="icon" type="image/x-icon">
    <script type="text/javascript" src="../javascript/scripts.js"></script>
    <script type="text/javascript" src="../javascript/settings.js"></script>
  </head>
  <body>
    <div id="navbox">
      <ul id="ulnav">
        <a href="index.php" id="navlogo" alt="Amoray Pizza Logo"></a>
        <button onclick="openNav()" id="openNav" class="navbutton"></button>
        <button onclick="closeNav()" id="closeNav" class="navbutton"></button>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'index.php';}, 300), pageTransitionOut();;">Home</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'menu.php';}, 300), pageTransitionOut();;">Menu</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'about.php';}, 300), pageTransitionOut();;">About</a></li>
        <li class="linav"><a onclick="setTimeout(function () {location.href = 'contact.php';}, 300), pageTransitionOut();;">Contact</a></li>
        <a id="accountImg" alt="User Account"></a>
        <div class="dropdown" id="dropdown">
          <button onclick="dropdownFunction()" class="dropbtn"><img src="../images/cart.png" class="cartImg" /><span id="cartText">Cart</span><span>$0.00</span></button>
          <div id="myDropdown" class="dropdown-content">
            <a href="#Test_item">Test item</a>
            <a href="#Test_item">Test item</a>
            <a href="#Test_item">Test item</a>
            <a href="#Test_item">Test item</a>
            <button class="checkout" onclick="setTimeout(function () {location.href = 'checkout.html';}, 300), pageTransitionOut(), dropdownFunction();;" >Checkout</button>
          </div>
        </div>
      </ul>
    </div>

    <div id="content">
      <div id="pageSettings">
        <div class="menuButtons">
          <span>Settings</span>
          <button onclick="hideAll(), clickHome()" class="navButton">
            <img src="../images/homeIcon.png" class="navButtonImg" id="navHome"/>
            <span class="navButtonText">Home</span>
          </button>
          <button onclick="hideAll(), clickADA()" class="navButton">
            <img src="../images/createIcon.png" class="navButtonImg" />
            <span class="navButtonText">Accessibility</span>
          </button>
          <button onclick="hideAll(), clickStyle()" class="navButton">
            <img src="../images/styleIcon.png" class="navButtonImg" />
            <span class="navButtonText">Style</span>
          </button>
          <button onclick="hideAll(), clickBilling()" class="navButton">
            <img src="../images/billingIcon.png" class="navButtonImg" />
            <span class="navButtonText">Billing</span>
          </button>
          <!--Only show these screens if logged in-->
          <!--<hr><span>Coming SoonTM</span>
          <button onclick="hideAll(), clickNewUser()" class="navButton">
            <img src="../images/createIcon.png" class="navButtonImg" />
            <span class="navButtonText">Signup</span>
          </button>
          <button onclick="hideAll(), clickLogin()" class="navButton">
            <img src="../images/loginIcon.png" class="navButtonImg"  />
            <span class="navButtonText">Login</span>
          </button>
          <button onclick="hideAll(), clickLogout()" class="navButton buttonLogout">
            <img src="../images/logoutIcon.png" class="navButtonImg" />
            <span class="navButtonText">Logout</span>
          </button>-->
        </div>


        <!--Log in by looking-->
        <div id="menuContent">

        <!--Home page for welcomes and quick settings-->
          <div id="settingHome"><center>
            <span class="title">Home</span><br><br>
            <h2 class="title">Welcome {sql username here}</h2>
          </div></center>
          
          <div id="settingADA"><center>
            <span class="title">Accessibility</span><br><br>
            <h2 class="title"></h2>
          </div></center>



          <!--Account page with billing info-->
          <div id="settingBilling">
            <div id="paymentDiv">
              <span class="title">Update Payment Info</span><br>
              <form method="POST" action="insert.php">
                <span class="formText typeInline">First Name*</span>
                <span class="formText typeInline">Last Name*</span><br>
                <input type="text" name="firstname" value="" class="formInput typeSmall">
                <input type="text" name="lastname" value="" class="formInput typeSmall"><br>
      
                <span class="formText">Address*</span><br>
                <input type="text" name="contact" value="" class="formInput typeLarge"><br>
                <span class="formText typeInline">City*</span>
                <span class="formText typeInline">State*</span>
                <span class="formText typeInline">Zip*</span><br>
                <input type="text" name="city" value="" class="formInput typeTiny">
                <select name="state" class="formInput typeTiny"></select>
                <input type="text" name="zip" value="" class="formInput typeTiny"><br>
      
                <span class="formText">Email</span><br>
                <input type="text" name="email" value="" class="formInput typeLarge"><br>
                <span class="formText">Phone</span><br>
                <input type="text" name="phone" value="" class="formInput typeLarge">
      
                <span class="formText">Card Info*</span><br>
                <input type="text" name="cardNumber" value="" class="formInput"><br>
                <span class="formText typeInline">Expiry*</span>
                <span class="formText typeInline">CVV*</span><br>
                <input type="text" name="cardExpiry" value="" class="formInput">
                <input type="text" name="cardCVV" value="" class="formInput"><br>
                <input type="submit" value="Submit" class="buttonSubmit">
              </div>
          </div>


          <!--Some CSS style changes (dark mode) if we have time-->
          <div id="settingStyle"><center>
            <span class="title">Style</span><br><br><br>
            <div class="parallax" id="pageimage"></div>
          </div></center>








          <!--NOT IN USE RIGHT NOW-->
          <div id="settingLogout"><center>
            <span class="title">Logout</span><br>
            <span class="subtitle">Are you sure you want to log out?</span><br><br>
            <span class="subtitle">Rememeber that you are {sql username here} with an email of {sql email here}</span><br><br>
            <input type="submit" value="Yes" class="buttonSubmit">
          </div></center>

          <div id="settingLogin"><center>
            <span class="title">Login</span><br>
            <form method="post" action="index.php" id="form"><br>
              <span class="subtitle">Username:</span><br>
              <input type="text" name="username" value="" class="formInput typeLarge"><br>
              <span class="subtitle">Password:</span><br>
              <input type="password" name="password" value="" class="formInput typeLarge"><br>
              <input type="submit" value="Submit" class="buttonSubmit">

              <br><br><br><br><span class="subtitle">If not logged in, show Login screen, else show Home screen</span>
          </div></center>
          

          <div id="settingNewUser"><center>
            <span class="title">Create An Account</span><br>
            <form method="post" action="index.php" id="form"><br>
              <span class="subtitle">Username:</span><br>
              <input type="text" name="username" value="" class="formInput typeLarge"><br>
              <span class="subtitle">Email:</span><br>
              <input type="text" name="username" value="" class="formInput typeLarge"><br>
              <span class="subtitle">Password:</span><br>
              <input type="password" name="password" value="" class="formInput typeLarge"><br>
              <input type="submit" value="Submit" class="buttonSubmit">
          </div></center>

        </div>
      </div>
      <script>
        window.onscroll = function() {scrollFunction()};
        pageTransitionIn();
        settingsTransition();
      </script>
    </div>
  </body>
</html>
