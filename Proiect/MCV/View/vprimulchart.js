import {CPrimulChart} from "../Controller/cprimulchart.js";

function drawFirstChart(locatie) {
	let obese = CPrimulChart(locatie);
	var data = new google.visualization.DataTable();

	data.addColumn('number', 'An');
	data.addColumn('number', 'Cazuri');

	for(var i=0 ; i < obese.length ; i++)
	{
		data.addRows([[obese[i].label , obese[i].y ]
			]);
	}

	var options = {
		title: 'Obesity by years',
		legend: { position: 'bottom' }
	};

	var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	
	var btnSave = document.getElementById('savepng');

	google.visualization.events.addListener(chart, 'ready', function () {
			btnSave.disabled = false;
	  });

	btnSave.addEventListener('click', function () {
		
		var imgUri=chart.getImageURI();
		let link = document.createElement('a');
		link.href = imgUri;
		link.download = "chart.png";
		link.click();
		link = null;
	  }, false);
	
	var btnSave1 = document.getElementById('savepdf');
    google.visualization.events.addListener(chart, 'ready', function () {
    btnSave1.disabled = false;
  });

  btnSave1.addEventListener('click', function () {
    var doc = new jsPDF();
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('chart.pdf');
  }, false); 
  
	
	
	chart.draw(data, options);
	document.getElementById("savecsv").style.display = "block";
	document.getElementById("savecsv1").style.display = "none";
	document.getElementById("savecsv2").style.display = "none";
	document.getElementById("savepdf").style.display = "block";
	document.getElementById("savepdf1").style.display = "none";
	document.getElementById("savepdf2").style.display = "none";
	document.getElementById("savepng").style.display = "block";
	document.getElementById("savepng1").style.display = "none";
	document.getElementById("savepng2").style.display = "none";
}
export{drawFirstChart};
