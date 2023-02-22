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



function resetFoods() {
    document.getElementById("itemPizza").style.display = "none";
    document.getElementById("itemWings").style.display = "none";
    document.getElementById("itemSides").style.display = "none";
    document.getElementById("itemDrinks").style.display = "none";
    document.getElementById("itemMore").style.display = "none";
}

function selectPizza() {
    document.getElementById("itemPizza").style.display = "flex";
}
function selectWings() {
    document.getElementById("itemWings").style.display = "flex";
}
function selectSides() {
    document.getElementById("itemSides").style.display = "flex";
}
function selectDrinks() {
    document.getElementById("itemDrinks").style.display = "flex";
}
function selectMore() {
    document.getElementById("itemMore").style.display = "flex";
}