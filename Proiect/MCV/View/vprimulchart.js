import {CPrimulChart} from "../Controller/cprimulchart.js";
	
function drawFirstChart(locatie) {
	let obese = CPrimulChart(locatie);
	var data = new google.visualization.DataTable();

	data.addColumn('number', 'An');
	data.addColumn('number', 'Cazuri');

	for(var i=0 ; i < obese.length ; i++)
	{
		data.addRows([[obese[i].label , obese[i].y]
			]);
	}

	var options = {
	title: 'Obesity by years',
	legend: { position: 'left' }
	};

	var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

	chart.draw(data, options);
}


export {drawFirstChart};