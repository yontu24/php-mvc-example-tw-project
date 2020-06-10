const url = 'http://localhost/TW/Proiect_TW/Model/mgetbylocation.php';
const xhr = new XMLHttpRequest();

// listen for `load` event
xhr.onload = () => {

    // print JSON response
    if (xhr.status >= 200 && xhr.status < 300) {
        // parse JSON
        const response = JSON.parse(xhr.responseText);
		// console.log(response.message);
		console.log(response.values[1].an);
    }
};

// create a JSON object
const json = {
    "locatie": "Puerto Rico"
};

// open request
xhr.open('POST', url);

// set `Content-Type` header
xhr.setRequestHeader('Content-Type', 'application/json');

// send rquest with JSON payload
xhr.send(JSON.stringify(json));