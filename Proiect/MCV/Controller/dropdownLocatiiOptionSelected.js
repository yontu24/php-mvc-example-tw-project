import {functie1} from "./functie1.js";
import {drawChart}from "../View/functie2.js";
//import {functieda} from "./buildDropdownAni";

let theDropdown1 = document.getElementById("dropdownLocatii");
theDropdown1.onclick = function () {
    for (var i = 1; i < theDropdown1.options.length; i++) {
        if (theDropdown1.options[i].selected == true) {
			let a=functie1(theDropdown1.options[i].text);
			let b=drawChart(a,theDropdown1.options[i].text);
            b.render();
            functieda(theDropdown1.options[i].text);
        }
    }
 }


