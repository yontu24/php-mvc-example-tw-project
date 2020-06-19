<?php
$data = $data1;
//echo '<pre>';
//print_r($data);
//echo '</pre>';
?>
<html>
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var response = <?php echo json_encode($data) ?>;

            var data = new google.visualization.DataTable();

            var loc1, loc2, year1, year2, res1, res2, category;
            loc1 = localStorage.getItem('firstLocation');
            loc2 = localStorage.getItem('secondLocation');
            year1 = localStorage.getItem('firstYear');
            year2 = localStorage.getItem('secondYear');
            res1 = localStorage.getItem('firstResponse');
            res2 = localStorage.getItem('secondResponse');
            category = localStorage.getItem('category');

            data.addColumn('string', 'categorie');
            data.addColumn('number', loc1);
            data.addColumn('number', loc2);

            var i;
            for (i = 0; i < Math.min(response[0].length, response[1].length); i++) {
                data.addRow([
                    response[0][i][0],
                    parseInt(response[0][i][1], 10),
                    parseInt(response[1][i][1], 10)
                ]);
            }
            var options = {
                title: 'Obesity of ' + loc1 + " (" + year1 + ", response: " + res1 + ")" +
                    " in comparison with " + loc2 + " (" + year2 + ", response: " + res2 + ")" +
                    " rendered on " + category,
                description: 'Nu stiu ce sa pun aici',
                legend: { position: 'bottom' }
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
<!--Div that will hold the pie chart-->
<div id="chart_div"></div>
</body>
</html>