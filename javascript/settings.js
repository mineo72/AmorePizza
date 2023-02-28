/*Select settings to show*/

function hideAll() {
    document.getElementById("settingHome").style.display = "none";
    document.getElementById("settingAccount").style.display = "none";
    document.getElementById("settingStyle").style.display = "none";
    document.getElementById("settingLogin").style.display = "none";
    document.getElementById("settingLogout").style.display = "none";
    document.getElementById("settingNewUser").style.display = "none";
}

function clickHome() {
    document.getElementById("settingHome").style.display = "block";
}
function clickAccount() {
    document.getElementById("settingAccount").style.display = "block";
}
function clickStyle() {
    document.getElementById("settingStyle").style.display = "block";
}

function clickLogin() {
    document.getElementById("settingLogin").style.display = "block";
}
function clickLogout() {
    document.getElementById("settingLogout").style.display = "block";
}
function clickNewUser() {
    document.getElementById("settingNewUser").style.display = "block";
}

/*Select food to show*/

function foodProcess(){
    document.getElementById("menuItemBox").style.marginTop = "110%";
    setTimeout(resetFoods, 200)
}

function resetFoods() {
    document.getElementById("itemPizza").style.display = "none";
    document.getElementById("itemWings").style.display = "none";
    document.getElementById("itemSides").style.display = "none";
    document.getElementById("itemDrinks").style.display = "none";
    document.getElementById("itemMore").style.display = "none";
    
    document.getElementById("food1").style.backgroundColor = "#5f8d37";
    document.getElementById("food2").style.backgroundColor = "#5f8d37";
    document.getElementById("food3").style.backgroundColor = "#5f8d37";
    document.getElementById("food4").style.backgroundColor = "#5f8d37";
    document.getElementById("food5").style.backgroundColor = "#5f8d37";

    document.getElementById("menuItemBox").style.marginTop = "30px";
}

function selectPizza() {
    document.getElementById("itemPizza").style.display = "flex";
    document.getElementById("food1").style.backgroundColor = "#bb3e00";
}
function selectWings() {
    document.getElementById("itemWings").style.display = "flex";
    document.getElementById("food2").style.backgroundColor = "#bb3e00";
}
function selectSides() {
    document.getElementById("itemSides").style.display = "flex";
    document.getElementById("food3").style.backgroundColor = "#bb3e00";
}
function selectDrinks() {
    document.getElementById("itemDrinks").style.display = "flex";
    document.getElementById("food4").style.backgroundColor = "#bb3e00";
}
function selectMore() {
    document.getElementById("itemMore").style.display = "flex";
    document.getElementById("food5").style.backgroundColor = "#bb3e00";
}



