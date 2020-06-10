import {functie1} from "./functie1.js";
import {drawChart}from "../View/functie2.js";

let theDropdown2 = document.getElementById("dropdownAni");
theDropdown2.onclick = function () {
    for (var i = 1; i < theDropdown2.options.length; i++) {
        if (theDropdown2.options[i].selected == true) {
			// let a=functie1(theDropdown2.options[i].text);
			// let b=drawChart(a,theDropdown2.options[i].text);
            // b.render();
            console.log(theDropdown2.options[i].text);
        }
    }
 }


