function hideAll() {
    document.getElementById("settingHome").style.display = "none";
    document.getElementById("settingAccount").style.display = "none";
    document.getElementById("settingStyle").style.display = "none";
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



function resetFoods() {
    document.getElementById("itemPizza").style.display = "none";
    document.getElementById("itemWings").style.display = "none";
    document.getElementById("itemSides").style.display = "none";
    document.getElementById("itemDrinks").style.display = "none";
    document.getElementById("itemMore").style.display = "none";
}

function selectPizza() {
    document.getElementById("itemPizza").style.display = "block";
}
function selectWings() {
    document.getElementById("itemWings").style.display = "block";
}
function selectSides() {
    document.getElementById("itemSides").style.display = "block";
}
function selectDrinks() {
    document.getElementById("itemDrinks").style.display = "block";
}
function selectMore() {
    document.getElementById("itemMore").style.display = "block";
}