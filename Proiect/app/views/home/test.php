<?php $date=$data;

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
    console.log(obj[1][0][0]);
    console.log(obj[1][1][0]);
    console.log(obj.length);
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'categorie');
    data.addColumn('number', 'cazuri');

    for(var i=0 ; i < obj.length ; i++)
    {
      console.log(i);
      data.addRow([ obj[i][0][0],parseInt(obj[i][1][0],10)
    ]);
  }
  var options = {
          title: 'Obezitate '
        };
  console.log(data);
  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data,options);
}

</script>
</head>

<body>
  <!--Div that will hold the pie chart-->
  <div id="chart_div"></div>
</body>
</html>
