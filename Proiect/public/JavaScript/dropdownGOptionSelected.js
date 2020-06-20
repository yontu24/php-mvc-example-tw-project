
let theDropdown3 = document.getElementById("dropdownG");

let lastOption3 = document.createElement('option');

theDropdown3.onclick = function () {
    for (var i = 1; i < theDropdown3.options.length; i++) {
        if (theDropdown3.options[i].selected == true && lastOption3 != theDropdown3.options[i]) {
            lastOption3 = theDropdown3.options[i];
			      var optiune = theDropdown3.options[i].text;
            localStorage.setItem("gender",optiune);
            CDropdownLocatii();
        }
    }
 }
