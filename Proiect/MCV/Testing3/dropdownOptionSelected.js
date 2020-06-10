//let theDropdown = document.getElementById("locality-dropdown");
import {functie1} from "./functie1.js";
import {functie3} from "./functie3.js";
import {drawChart,drawChart2}from "./functie2.js";

let theDropdown = document.getElementById("locality-dropdown");
theDropdown.onclick=
function () {
    for (var i = 1; i < theDropdown.options.length; i++) {
        if (theDropdown.options[i].selected == true) {
			//let a=functie1(theDropdown.options[i].text);
			//let b=drawChart(a,theDropdown.options[i].text);
			let a=functie3(theDropdown.options[i].text,'2015');
			let b=drawChart2(a,theDropdown.options[i].text,'2015');
			b.render();
        }
    }
 }


