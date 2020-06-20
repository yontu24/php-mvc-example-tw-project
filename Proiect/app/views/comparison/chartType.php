<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/checkboxes.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/index.css">
    <link rel="icon" href="http://localhost/OBIS/public/icons/webicon.png" type="image/x-icon">
</head>
<body>
<div class="nav-bar">
    <!--        DE ADAUGAT DOCUMENTATIA -->
    <a class="item-home" href="../../public/index.php" title="Home">Press me</a>
    <a class="item-contact" href="#contact" title="Contact us">Press me</a>
    <a class="item-lang" href="#" title="Documentation">Press me</a>
    <style>.nav-bar{position: unset;}</style>
</div>
<div class="container">
    <h1>STEP 2</h1>
    <form action="../comparisons/index" method="post">

        <div class="checkbox-container">

            <input type="radio" name="filterChart" value='plotchart' checked > PlotChart <br>
            <input type="radio" name="filterChart" value='linechart'  > LineChart <br>
            <input type="radio" name="filterChart" value='barchart'  > BarChart <br>

        </div>
        <input type="submit" name="action" value="Submit">
    </form>
</div>
</body>
</html>
