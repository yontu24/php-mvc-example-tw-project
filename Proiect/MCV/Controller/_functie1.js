function functie1(locatie){
	const url = 'http://localhost/TW/Proiect_TW/Model/mgetbylocation.php';
	const xhr = new XMLHttpRequest();
	var obese = [];
	var dataPoints2 = [];
	xhr.onload = () => {
		var anul=0;
		var ob=0;
		
		if (xhr.status >= 200 && xhr.status < 300) {
			const response = JSON.parse(xhr.responseText);
			for (var i = 0; i < response.values.length; i++)
			{
				console.log("sunt la grafic si am anul " + response.values[i].an);
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
			console.log("sunt la obezi si am  " + ob);
			obese.shift();
			obese.push({
				an: anul,
				cazuri: ob
			});
			for(var i=0;i<obese.length;i++)
			{
				dataPoints2.push({ y:obese[i].cazuri ,label :obese[i].an});
			}
			
		}
	}

	const json = {
		"locatie": locatie
	};
	console.log(json);
	console.log(locatie);

	xhr.open('POST', url);

	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send(JSON.stringify(json));
	return dataPoints2;

}

export {functie1};