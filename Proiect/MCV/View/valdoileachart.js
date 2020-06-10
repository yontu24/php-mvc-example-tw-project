import {CAlDoileaChart} from "../Controller/caldoileachart.js";
	
function drawSecondChart(locatie,an) {
	let obese = CAlDoileaChart(locatie,an);
	console.log(obese);
	var data = new google.visualization.DataTable();

	data.addColumn('string', 'IDcategorie');
	data.addColumn('number', 'Cazuri');

	for(var i=0 ; i < obese.length ; i++)
	{
		data.addRows([[obese[i].label , obese[i].y]
			]);
	}
	console.log(data);
	var options = {
	title: 'Obesity by age category in year '+an,
	legend: { position: 'left' }
	};

	var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

	chart.draw(data, options);
}


export {drawSecondChart};