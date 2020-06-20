import {requestF} from "./requestF.js";
import {requestM} from "./requestM.js";
let theDropdown2 = document.getElementById("dropdownAni");

let lastOption2 = document.createElement('option');

theDropdown2.onclick = function () {
    for (var i = 1; i < theDropdown2.options.length; i++) {
        if (theDropdown2.options[i].selected == true && lastOption2 != theDropdown2.options[i]) {
            lastOption2 = theDropdown2.options[i];
			      var optiune = theDropdown2.options[i].text;
            var num = theDropdown2.options[i].text.toString();
            if (num > 2010 && num < 2021)
            {
              var opt1=localStorage.getItem("gender");
              var opt2=localStorage.getItem("locatie");
              if(opt1=='Male'){requestM(num,opt2); }
              else {requestF(num,opt2); }
            }
        }
    }
 }
