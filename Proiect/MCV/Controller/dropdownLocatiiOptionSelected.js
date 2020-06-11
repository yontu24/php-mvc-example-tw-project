import {drawFirstChart}from "../View/vprimulchart.js";

let theDropdown1 = document.getElementById("dropdownLocatii");

let lastOption1 = document.createElement('option');

theDropdown1.onclick = function () {
    for (var i = 1; i < theDropdown1.options.length; i++) {
        if (theDropdown1.options[i].selected == true && lastOption1 != theDropdown1.options[i]) {
            lastOption1 = theDropdown1.options[i];
            var optiune = theDropdown1.options[i].text;
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(
                function() {
                     drawFirstChart(optiune);
                  });
				localStorage.setItem("locatie", optiune);
			
            CDropdownAni(theDropdown1.options[i].text);
            document.getElementById("curve_chart").style.display = "block";
            document.getElementById("pie_chart").style.display = "none";
            document.getElementById("bar_chart").style.display = "none";
            
        }
    }

}