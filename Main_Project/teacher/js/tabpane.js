//Tabpane
let tabHeader = document.getElementsByClassName("tab-header")[0];
let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
let tabBody = document.getElementsByClassName("tab-body")[0];

let tabsPane = tabHeader.getElementsByTagName("div");

let danger = document.getElementsByClassName("dangerBtn");

for (let i = 0; i < tabsPane.length; i++) {
    tabsPane[i].addEventListener("click", function() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[i].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByClassName("tab-content")[i].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 5) * ${i})`;
    });


}

//Tester
function showModuleTab() {
    tabHeader.getElementsByClassName("active")[0].classList.remove("active");
    tabsPane[0].classList.add("active");
    tabBody.getElementsByClassName("active")[0].classList.remove("active");
    tabBody.getElementsByClassName("tab-content")[0].classList.add("active");

    tabIndicator.style.left = `calc(calc(100% / 5) * ${0})`;
}

function showTaskTab() {
    tabHeader.getElementsByClassName("active")[0].classList.remove("active");
    tabsPane[1].classList.add("active");
    tabBody.getElementsByClassName("active")[0].classList.remove("active");
    tabBody.getElementsByClassName("tab-content")[1].classList.add("active");

    tabIndicator.style.left = `calc(calc(100% / 5) * ${1})`;
}

function showProgress() {
    tabHeader.getElementsByClassName("active")[0].classList.remove("active");
    tabsPane[2].classList.add("active");
    tabBody.getElementsByClassName("active")[0].classList.remove("active");
    tabBody.getElementsByClassName("tab-content")[2].classList.add("active");

    tabIndicator.style.left = `calc(calc(100% / 5) * ${2})`;
}

function showGradingTab() {
    tabHeader.getElementsByClassName("active")[0].classList.remove("active");
    tabsPane[3].classList.add("active");
    tabBody.getElementsByClassName("active")[0].classList.remove("active");
    tabBody.getElementsByClassName("tab-content")[3].classList.add("active");

    tabIndicator.style.left = `calc(calc(100% / 5) * ${3})`;
}

function showToCheck() {
    tabHeader.getElementsByClassName("active")[0].classList.remove("active");
    tabsPane[4].classList.add("active");
    tabBody.getElementsByClassName("active")[0].classList.remove("active");
    tabBody.getElementsByClassName("tab-content")[4].classList.add("active");

    tabIndicator.style.left = `calc(calc(100% / 5) * ${4})`;
}