<?php $date=$data3;

?>
<html>
<head>
  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/StatisticsChart.css">

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
    data.addColumn('string', 'label');
    data.addColumn('number', 'cazuri');

    for(var i=0 ; i < obj.length ; i++)
    {
      console.log(i);
      data.addRow([ obj[i][0][0],parseInt(obj[i][1][0],10)
    ]);
  }
  var options = {
    title: 'Number of cases of '+localStorage.getItem('response')+' people  in '+localStorage.getItem('location')+', year(s): '+localStorage.getItem('year')
  };
  console.log(data);
  // Instantiate and draw our chart, passing in some options.
  <?php if(isset($_POST['filterChart'])){
    if($_POST['filterChart']=='piechart'){?>
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      <?php } if($_POST['filterChart']=='barchart'){?>
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        <?php } if($_POST['filterChart']=='linechart'){?>
          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          <?php }}?>

          chart.draw(data,options);
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


          var btnSave2 = document.getElementById('savecsv');
          google.visualization.events.addListener(chart, 'ready', function () {
            btnSave2.disabled = false;
          });

          btnSave2.addEventListener('click', function () {
            var csv1 = google.visualization.dataTableToCsv(data);
            let link1 = document.createElement('a');
            link1.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv1));
            link1.setAttribute('download', 'dateChart.csv');
            link1.click();
            link1 = null;
          }, false);




          //document.getElementById('savecsv').outerHTML = '<a  href="' + csv2 + '" download="chart.csv" target="_blank">Convert to CSV</a>';
        }
        window.addEventListener('resize', drawChart);
        </script>
</head>

    <body>
        <!--Div that will hold the pie chart-->
        <div class="nav-bar">
          <!--        DE ADAUGAT DOCUMENTATIA -->
          <a class="item-home" href="index" title="Home">Press me</a>
          <a class="item-contact" href="#contact" title="Contact us">Press me</a>
          <a class="item-lang" href="#" title="Documentation">Press me</a>
          <style>.nav-bar{position: unset;}</style>
        </div>
        <div class="container">
        <div id="chart_introduction">
            <br>The results for the filters you applied are: <br><br>

        </div>
        <div class="row">


        <div id="chart_div" class="chart"></div>

        </div>
        <div class="export_btns">
            <button class="btn btn-1 btn-sep icon-info" id="savepdf" type="button">Export as PDF File</button>
            <button class="btn btn-1 btn-sep icon-info" id="savepng" type="button">Export as PNG File</button>
            <button class="btn btn-1 btn-sep icon-info" id="savecsv" type="button">Export as CSV File</button>
        </div>
        </div>
    </body>
</html>
