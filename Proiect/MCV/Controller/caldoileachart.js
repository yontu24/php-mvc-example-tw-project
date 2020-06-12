function CAlDoileaChart(locatie,an){
	const url = 'http://localhost/TW/proiecttw/Model/mgetbyyears.php';
	const xhr = new XMLHttpRequest();
	
	var dataPoints2 = [];
	xhr.onload = () => {
		
		if (xhr.status >= 200 && xhr.status < 300) {
			const response = JSON.parse(xhr.responseText);
			console.log(response);
			for (var i = 0; i < response.values.length; i++)
			{
				// if (parseInt(response.values[i].an, 10) == an) {
					dataPoints2.push({ 
						y:parseInt(response.values[i].cazuri, 10),
						label :response.values[i].categorie
					});
				// }
			}
		}
	}

	const json = {
		"an": an,
		"locatie": locatie
	};

	xhr.open('POST', url,false);

	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send(JSON.stringify(json));

	return dataPoints2;

}

export {CAlDoileaChart};