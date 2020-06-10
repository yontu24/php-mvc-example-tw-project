//let theDropdown = document.getElementById("locality-dropdown");
import {functie1} from "./functie1.js";
import {drawChart}from "./functie2.js";

let theDropdown = document.getElementById("locality-dropdown");
theDropdown.onclick=
function () {
    for (var i = 1; i < theDropdown.options.length; i++) {
        if (theDropdown.options[i].selected == true) {
			let a=functie1(theDropdown.options[i].text);
			let b=drawChart(a,theDropdown.options[i].text);
			b.render();
        }
    }
 }


