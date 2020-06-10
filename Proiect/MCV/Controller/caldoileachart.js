function CAlDoileaChart(locatie,an){
	const url = 'http://localhost/Proiect_2/MCV/Model/mgetbylocation.php';
	const xhr = new XMLHttpRequest();
	var obese = [];
	
	console.log(an);
	var dataPoints2 = [];
	var idcat="CAT1";
	xhr.onload = () => {
		var anul=0;
		var ob=0;
		
		if (xhr.status >= 200 && xhr.status < 300) {
			const response = JSON.parse(xhr.responseText);
			for (var i = 0; i < response.values.length; i++)
			{
				if (parseInt(response.values[i].an, 10) == an) {
				if (!idcat.includes(response.values[i].IDcategorie))
				{obese.push({
				IDcategorie:idcat ,
				cazuri:ob
				});
				idcat=response.values[i].IDcategorie;
				ob = 0;
				}
				else
				{
					ob = ob + (parseInt(response.values[i].cazuri, 10));
				}
				}
			}
			
			for(var i=0;i<obese.length;i++)
			{
				dataPoints2.push({ y:obese[i].cazuri ,label :obese[i].IDcategorie});
			}
		}
	}

	const json = {
		"locatie": locatie
	};
	console.log(json);
	console.log(locatie);

	xhr.open('POST', url,false);

	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send(JSON.stringify(json));
	return dataPoints2;

}

export {CAlDoileaChart};