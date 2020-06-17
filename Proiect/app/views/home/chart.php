<?php $date=$data;
print_r($date);
?>
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
    var obj = <?php echo json_encode($date) ?>;
    console.log(obj);
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'index');
    data.addColumn('number', 'an');
    for(var i=0 ; i < obj.length ; i++)
    {
      console.log(i);
      data.addRow([i,parseInt( obj[i],10)
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
