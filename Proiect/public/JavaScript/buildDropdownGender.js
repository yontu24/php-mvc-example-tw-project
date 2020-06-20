let dropdownG = document.getElementById('dropdownG');
dropdownG.length = 0;

let defaultOption3 = document.createElement('option');
defaultOption3.text = 'Choose a gender';

dropdownG.add(defaultOption3);
dropdownG.selectedIndex = 0;

	//document.getElementById("cevaD").style.visibility = "hidden";
	dropdownG.length = 0;

  defaultOption3 = document.createElement('option');
	defaultOption3.text = 'Choose Gender';

	dropdownG.add(defaultOption3);
	dropdownG.selectedIndex = 0;
  option = document.createElement('option');
  option.text = 'Male';
  dropdownG.add(option);
  option = document.createElement('option');
  option.text = 'Female';
  dropdownG.add(option);
