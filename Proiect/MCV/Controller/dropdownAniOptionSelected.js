import {functie1} from "./functie1.js";
import {drawSecondChart}from "../View/valdoileachart.js";
import {drawThirdChart}from "../View/valtreileachart.js";
let theDropdown2 = document.getElementById("dropdownAni");
theDropdown2.onclick = function () {
    for (var i = 1; i < theDropdown2.options.length; i++) {
        if (theDropdown2.options[i].selected == true) {
			// let a=functie1(theDropdown2.options[i].text);
			// let b=drawChart(a,theDropdown2.options[i].text);
            // b.render();
			var optiune = theDropdown2.options[i].text;
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(
                function() {
					var opt=localStorage.getItem("locatie");
                     drawSecondChart(opt,optiune);
					 drawThirdChart(opt,optiune);
                  });
				  
            console.log(theDropdown2.options[i].text);
        }
    }
 }


