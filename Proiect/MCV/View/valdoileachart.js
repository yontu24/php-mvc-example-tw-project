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
	var btnSave = document.getElementById('savepng1');

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
	  var btnSave1 = document.getElementById('savepdf1');
    google.visualization.events.addListener(chart, 'ready', function () {
    btnSave1.disabled = false;
  });

  btnSave1.addEventListener('click', function () {
    var doc = new jsPDF();
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('chart.pdf');
  }, false); 
	  
	chart.draw(data, options);
	document.getElementById("savecsv").style.display = "none";
	document.getElementById("savecsv1").style.display = "block";
	document.getElementById("savecsv2").style.display = "block";
	document.getElementById("savepdf").style.display = "none";
	document.getElementById("savepdf1").style.display = "block";
	document.getElementById("savepdf2").style.display = "block";
	document.getElementById("savepng").style.display = "none";
	document.getElementById("savepng1").style.display = "block";
	document.getElementById("savepng2").style.display = "block";
}


export {drawSecondChart};