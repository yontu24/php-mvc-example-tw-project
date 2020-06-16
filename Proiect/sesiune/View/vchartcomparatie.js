import {CPrimulChart} from "../Controller/cgetbyyears.js";
var date=[];
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
	for(var i=0 ; i < obese1.length ; i++)
	{
		date.push([[obese1[i].label , obese1[i].y ]]);
	}
	for(var i=0 ; i < obese2.length ; i++)
	{
		date.push([[obese2[i].label , obese2[i].y ]]);
	}

	var options = {
        title: 'Obesity of ' + locatie1 + " in comparison with " + locatie2,
        legend: { position: 'bottom' }
	};

	var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	var btnSave = document.getElementById('savepng3');

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
	
	var btnSave1 = document.getElementById('savepdf3');
    google.visualization.events.addListener(chart, 'ready', function () {
    btnSave1.disabled = false;
  });

  btnSave1.addEventListener('click', function () {
    var doc = new jsPDF();
    doc.addImage(chart.getImageURI(), 0, 0);
    doc.save('chart.pdf');
  }, false); 
  
	var btnSave2 = document.getElementById('savecsv3');
  btnSave2.addEventListener('click', function () {
	
	
	const items=date;
	console.log(date);
	console.log(items);
	const replacer = (key, value) => value === null ? '' : value;
    const header = Object.keys(items[0]);
    let csv = items.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','));
    csv.unshift(header.join(','));
    csv = csv.join('\r\n');

    // this trick will generate a temp "a" tag
    // https://stackoverflow.com/questions/8847766/how-to-convert-json-to-csv-format-and-store-in-a-variable
    var link = document.createElement("a");
    link.id = "doWNLink";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);

    var blob = new Blob([csv], { type: 'text/csv' });
    var csvUrl = window.webkitURL.createObjectURL(blob);
    var filename = 'UserExport.csv';
    $("#doWNLink")
        .attr({
            'download': filename,
            'href': csvUrl
        });

    $('#doWNLink')[0].click();
    document.body.removeChild(link)
	  
  },false);
	chart.draw(data, options);
	
	document.getElementById("savecsv").style.display = "none";
	document.getElementById("savecsv1").style.display = "none";
	document.getElementById("savecsv2").style.display = "none";
	document.getElementById("savecsv3").style.display = "block";
	document.getElementById("savepdf").style.display = "none";
	document.getElementById("savepdf1").style.display = "none";
	document.getElementById("savepdf2").style.display = "none";
	document.getElementById("savepdf3").style.display = "block";
	document.getElementById("savepng").style.display = "none";
	document.getElementById("savepng1").style.display = "none";
	document.getElementById("savepng2").style.display = "none";
	document.getElementById("savepng3").style.display = "block";
}


export {drawComaprisonChart};