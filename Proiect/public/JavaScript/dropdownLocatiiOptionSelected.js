
let theDropdown1 = document.getElementById("dropdownLocatii");

let lastOption1 = document.createElement('option');

theDropdown1.onclick = function () {
    for (var i = 1; i < theDropdown1.options.length; i++) {
        if (theDropdown1.options[i].selected == true && lastOption1 != theDropdown1.options[i]) {
            lastOption1 = theDropdown1.options[i];
            var optiune = theDropdown1.options[i].text;
            localStorage.setItem("locatie", optiune);
            CDropdownAni();


        }
    }

}
