<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
    var response;
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      const url = 'http://localhost/Proiect_5/rest/api/info/read.php?an=true';
	     const xhr = new XMLHttpRequest();
      xhr.onload = () => {

		if (xhr.status >= 200 && xhr.status < 300) {
		 response = JSON.parse(xhr.responseText);
			console.log(response);
    }
  }
  xhr.open('POST', url,false);

	xhr.setRequestHeader('Content-Type', 'application/json');

	xhr.send();
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'index');
	     data.addColumn('number', 'an');


        for(var i=0 ; i < response.values.length ; i++)
	       {console.log(i);
		         data.addRow([i,parseInt( response.values[i].ani,10)
			          ]);
	             }
               console.log(data);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data);
    }

    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
