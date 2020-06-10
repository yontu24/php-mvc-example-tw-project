//let theDropdown = document.getElementById("locality-dropdown");
import {functie1} from "./functie1.js";
import {drawChart}from "./functie2.js";
let a=functie1();
let b=drawChart(a);
let theDropdown = document.getElementById("locality-dropdown");
theDropdown.onclick=
function () {
    for (var i = 1; i < theDropdown.options.length; i++) {
        if (theDropdown.options[i].selected == true) {
			b.render();
        }
    }
 }


