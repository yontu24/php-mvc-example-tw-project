let dropdownLocatii = document.getElementById('dropdownLocatii');
dropdownLocatii.length = 0;

let defaultOption2 = document.createElement('option');
defaultOption2.text = 'Choose State/Province';

dropdownLocatii.add(defaultOption2);
dropdownLocatii.selectedIndex = 0;

const url2 = 'http://localhost/TW/Proiect_TW/Model/mgetlocations.php';

const request2 = new XMLHttpRequest();
request2.open('GET', url2, true);

request2.onload = function() {
	if (request2.status === 200) {
		const data = JSON.parse(request2.responseText);
		let option;
		for (let i = 0; i < data.values.length; i++) {
			option = document.createElement('option');
			option.text = data.values[i].Locationdesc;
			dropdownLocatii.add(option);
		}
	} else {
		// Reached the server, but it returned an error
	}   
}

request2.onerror = function() {
	console.error('An error occurred fetching the JSON from ' + url);
};

request2.send();