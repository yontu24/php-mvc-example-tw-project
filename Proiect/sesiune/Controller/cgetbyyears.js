function CPrimulChart(locatie){
	const url = 'http://localhost/TW/proiecttw/Model/mgetbylocation.php';
	const xhr = new XMLHttpRequest();
	var obese = [];
	var dataPoints2 = [];
	xhr.onload = () => {
		
		if (xhr.status >= 200 && xhr.status < 300) {
			const response = JSON.parse(xhr.responseText);
			console.log(response);
			var ob = 0;
			var totalByYears = 0;
			var anul = (parseInt(response.values[0].an, 10));

			for (var i = 0; i < response.values.length; i++)
			{
				if (parseInt(response.values[i].an, 10) != anul) {
					var procent = (ob * 100) / totalByYears;
					dataPoints2.push({ 
						y: procent ,
						label : anul
					});
					anul = (parseInt(response.values[i].an, 10));
					ob = 0;
					totalByYears = 0;
				}

				if (response.values[i].categorie.includes("Obese"))
					ob = ob + (parseInt(response.values[i].cazuri, 10));
				
				totalByYears = totalByYears + (parseInt(response.values[i].cazuri, 10));
			
			}
			var procent = (ob * 100) / totalByYears;
			dataPoints2.push({ 
				y: procent ,
				label : anul
			});
		}
	}

	const json = {
		"locatie": locatie
	};

	xhr.open('POST', url,false);

	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send(JSON.stringify(json));

	return dataPoints2;

}

export {CPrimulChart};