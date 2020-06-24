<?php $date = $data3;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Load the AJAX API-->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/StatisticsChart.css">
    <title>Statistics</title>
    <script>
        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages': ['corechart']});
        var response;
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var obj = <?php echo json_encode($date) ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'label');
            data.addColumn('number', 'cazuri');

            for (var i = 0; i < obj.length; i++) {
                data.addRow([
                    obj[i][0][0], parseInt(obj[i][1][0], 10)
                ]);
            }
            var options = {
                title: 'Number of cases of ' + localStorage.getItem('response') + ' people  in ' + localStorage.getItem('location') + ', year(s): ' + localStorage.getItem('year'),
                legend: {position: 'bottom'},
                colors: ['#428d38', '#32ff85', '#b9b6ff', '#88938d', '#44b35c', '#b9b6ff', '#264c23', 'rgba(139,255,139,0.64)']
            };
            // Instantiate and draw our chart, passing in some options.
            aux = localStorage.getItem('chartType');

            if (aux === "piechart") {
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            } else if (aux === "barchart") {
                var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            } else {
                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            }

            chart.draw(data, options);

            // WEBP
            var btnSave = document.getElementById('savewebp');
            google.visualization.events.addListener(chart, 'ready', function () {
                btnSave.disabled = false;
            });

            btnSave.addEventListener('click', function () {
                var imgUri = chart.getImageURI();
                let link = document.createElement('a');
                link.href = imgUri;
                link.download = "dateChart.webp";
                link.click();
                link = null;
            }, false);


            // PDF
            var btnSave1 = document.getElementById('savepdf');
            google.visualization.events.addListener(chart, 'ready', function () {
                btnSave1.disabled = false;
            });

            btnSave1.addEventListener('click', function () {
                var doc = new jsPDF();
                doc.addImage(chart.getImageURI(), 0, 0);
                doc.save('dateChart.pdf');
            }, false);


            // SVG
            var btnSave2 = document.getElementById('savesvg');
            btnSave2.addEventListener('click', function () {
                var svgAsXML = (new XMLSerializer).serializeToString(document.getElementsByTagName('svg')[0]);
                var svgData = "data:image/svg+xml," + encodeURIComponent(svgAsXML);

                let link1 = document.createElement('a');
                link1.setAttribute('href',"data:image/svg+xml," + encodeURIComponent(svgAsXML));
                link1.setAttribute('download', 'dateChart.svg');
                link1.click();
                link1 = null;
            }, false);


            // CSV
            var btnSave3 = document.getElementById('savecsv');
            google.visualization.events.addListener(chart, 'ready', function () {
                btnSave3.disabled = false;
            });

            btnSave3.addEventListener('click', function () {
                var csv1 = google.visualization.dataTableToCsv(data);
                let link1 = document.createElement('a');
                link1.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(csv1));
                link1.setAttribute('download', 'dateChart.csv');
                link1.click();
                link1 = null;
            }, false);
        }

        window.addEventListener('resize', drawChart);
    </script>
    <style>.nav-bar {
            position: unset;
        }</style>
</head>

<body>
<!--Div that will hold the pie chart-->
<div class="nav-bar">
    <!--        DE ADAUGAT DOCUMENTATIA -->
    <a class="item-home" href="../../public/home/index/" title="Home">Press me</a>
    <a class="item-lang" href="../../public/home/documentation" title="Documentation">Press me</a>
</div>
<div class="container">
    <button class="btn btn-1 btn-sep icon-back" onclick="window.location.href='../../public/results/index'"
            type="button">Draw another chart
    </button>
    <div id="chart_introduction">
        <br>The results for the filters you applied are: <br><br>
    </div>
    <div class="row">
        <div id="chart_div" class="chart"></div>
    </div>
    <div class="export_btns">
        <button class="btn btn-1 btn-sep icon-info" id="savepdf" type="button">Export as PDF File</button>
        <button class="btn btn-1 btn-sep icon-info" id="savewebp" type="button">Export as WEBP File</button>
        <button class="btn btn-1 btn-sep icon-info" id="savecsv" type="button">Export as CSV File</button>
        <button class="btn btn-1 btn-sep icon-info" id="savesvg" type="button">Export as SVG File</button>
    </div>
</div>
</body>
</html>
