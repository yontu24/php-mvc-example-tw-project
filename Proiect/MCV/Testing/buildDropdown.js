let dropdown = document.getElementById('locality-dropdown');
dropdown.length = 0;

let defaultOption = document.createElement('option');
defaultOption.text = 'Choose State/Province';

dropdown.add(defaultOption);
dropdown.selectedIndex = 0;

const url = 'http://localhost/TW/Proiect_TW/Model/mgetlocations.php';

const request = new XMLHttpRequest();
request.open('GET', url, true);

request.onload = function() {
	if (request.status === 200) {
		const data = JSON.parse(request.responseText);
		let option;
		for (let i = 0; i < data.values.length; i++) {
			option = document.createElement('option');
			option.text = data.values[i].Locationdesc;
			dropdown.add(option);
		}
	} else {
		// Reached the server, but it returned an error
	}   
}

request.onerror = function() {
	console.error('An error occurred fetching the JSON from ' + url);
};

request.send();


