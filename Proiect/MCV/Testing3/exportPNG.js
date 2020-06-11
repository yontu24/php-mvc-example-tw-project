google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Element', 'Density', { role: 'style' }],
        ['Copper', 8.94, '#b87333', ],
        ['Silver', 10.49, 'silver'],
        ['Gold', 19.30, 'gold'],
        ['Platinum', 21.45, 'color: #e5e4e2' ]
      ]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        bar: {groupWidth: '95%'},
        legend: 'none',
      };

      var chart_div = document.getElementById('chart_div');
      var chart = new google.visualization.ColumnChart(chart_div);
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
		link = null;;
  }, false);
	  

	  chart.draw(data, options);
	  }