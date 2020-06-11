import {CPrimulChart} from "../Controller/cprimulchart.js";
	
function drawComaprisonChart(locatie1,locatie2) {
    let obese1 = CPrimulChart(locatie1);
    let obese2 = CPrimulChart(locatie2);
	var data = new google.visualization.DataTable();

	data.addColumn('number', 'An');
	data.addColumn('number', locatie1);
	data.addColumn('number', locatie2);

	for(var i=0 ; i < obese1.length ; i++)
	{
		data.addRows([[obese1[i].label , obese1[i].y ,obese2[i].y]]);
	}

	var options = {
        title: 'Obesity of ' + locatie1 + " in comparison with " + locatie2,
        legend: { position: 'bottom' }
	};

	var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

	chart.draw(data, options);
}


export {drawComaprisonChart};