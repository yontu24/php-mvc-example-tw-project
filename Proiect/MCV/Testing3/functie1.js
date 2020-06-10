function functie1(locatie){
const url = 'http://localhost/Proiect_1/MCV/Model/mgetbylocation.php';
const xhr = new XMLHttpRequest();
var obese=[];
var dataPoints2=[];
// listen for `load` event
xhr.onload = () => {	
	
	
	var anul=0;
	var ob=0;
    // print JSON response
	var dataPoints1 =[];
	
    if (xhr.status >= 200 && xhr.status < 300) {
        // parse JSON
        const response = JSON.parse(xhr.responseText);
		for (var i = 0; i < response.values.length; i++)
		{
		if (parseInt(response.values[i].an, 10) != anul) {
			obese.push({
				an: anul,
				cazuri: ob
			});
			anul = (parseInt(response.values[i].an, 10));
			ob = 0;
		}

		if (response.values[i].categorie.includes("Obese"))
	
			ob = ob + (parseInt(response.values[i].cazuri, 10));
	
		}
		obese.shift();
		for(var i=0;i<obese.length;i++)
		{
			dataPoints2.push({ y:obese[i].cazuri ,label :obese[i].an});
		}
		
	};
}


// create a JSON object
const json = {
    "locatie": locatie
};
console.log(json);
console.log(locatie);
// open request
xhr.open('POST', url);

// set `Content-Type` header
xhr.setRequestHeader('Content-Type', 'application/json');

// send rquest with JSON payload
xhr.send(JSON.stringify(json));
return dataPoints2;
}
export {functie1};