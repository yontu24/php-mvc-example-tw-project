import {drawSecondChart}from "../View/valdoileachart.js";
import {drawThirdChart}from "../View/valtreileachart.js";
import {drawComaprisonChart}from "../View/vchartcomparatie.js";
let theDropdown2 = document.getElementById("dropdownAni");

let lastOption2 = document.createElement('option');

theDropdown2.onclick = function () {
    for (var i = 1; i < theDropdown2.options.length; i++) {
        if (theDropdown2.options[i].selected == true && lastOption2 != theDropdown2.options[i]) {
            lastOption2 = theDropdown2.options[i];
			var optiune = theDropdown2.options[i].text;
            google.charts.load('current', {'packages':['corechart']});
            
            var num = theDropdown2.options[i].text.toString();
            if (num > 2010 && num < 2021)
            {
                google.charts.setOnLoadCallback(
                    function() {
                        var opt = localStorage.getItem("locatie");
                         drawSecondChart(opt,optiune);
                         drawThirdChart(opt,optiune);
                      });
                      
                console.log(theDropdown2.options[i].text);
                document.getElementById("curve_chart").style.display = "none";
                document.getElementById("pie_chart").style.display = "block";
                document.getElementById("bar_chart").style.display = "block";
            }else{
                console.log("aici sa fac comparatie");
                google.charts.setOnLoadCallback(
                    function() {
                        var firstLocation = localStorage.getItem("locatie");
                        drawComaprisonChart(firstLocation,optiune);
                      });
                document.getElementById("curve_chart").style.display = "block";
                document.getElementById("pie_chart").style.display = "none";
                document.getElementById("bar_chart").style.display = "none";
            }
        }
    }
 }


