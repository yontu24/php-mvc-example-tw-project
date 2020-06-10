import {drawFirstChart}from "../View/vprimulchart.js";

let theDropdown1 = document.getElementById("dropdownLocatii");
theDropdown1.onclick = function () {
    for (var i = 1; i < theDropdown1.options.length; i++) {
        if (theDropdown1.options[i].selected == true) {
            var optiune = theDropdown1.options[i].text;
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(
                function() {
                     drawFirstChart(optiune);
                  });
            caldoileagraf(theDropdown1.options[i].text);
        }
    }
}