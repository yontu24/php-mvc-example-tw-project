<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/checkboxes.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/index.css">
    <link rel="icon" href="http://localhost/OBIS/public/icons/webicon.png" type="image/x-icon">
    <style>.nav-bar {
            position: unset;
        }</style>
</head>
<body>
<div class="nav-bar">
    <!--        DE ADAUGAT DOCUMENTATIA -->
    <a class="item-home" href="../../public/home/index/" title="Home">Press me</a>
    <a class="item-lang" href="../../public/home/documentation" title="Documentation">Press me</a>
</div>
<div class="container">
    <div class="stepText">
        <img id="s1img" src="../../public/icons/secondStep.jpg" alt="">
        <br><br>
        Choose the type of graph you want to render.<br><br>
        Each option bellow has a preview of the chart type it should render besides it.<br><br>
        <br><br>
        <form action="../statistics/index" method="post">
            <div class="CorS">
                <img src="../../public/icons/pieIcon.png" class="checkImg" alt="">
                <label class="checkbox-label">
                    <input type="radio" name="filterChart" value='piechart' checked>
                    <span class="checkmark"></span>
                </label>Pie Chart<br>
            </div>
            <br><br>
            <div class="CorS">
                <img src="../../public/icons/lineIcon.png" class="checkImg" alt="">
                <label class="checkbox-label">
                    <input type="radio" name="filterChart" value='linechart'>
                    <span class="checkmark"></span>
                </label>Line Chart<br>
            </div>
            <br><br>
            <div class="CorS">
                <img src="../../public/icons/barIcon.png" class="checkImg" alt="">
                <label class="checkbox-label">
                    <input type="radio" name="filterChart" value='barchart'>
                    <span class="checkmark"></span>
                </label>Bar Chart<br>
            </div>
            <input type="submit" name="action" value="Submit" class="submit">
        </form>
        <br><br>
        Want to modify your choices?<br>
        <form>
            <input type="button" class="submit" value="Return to previous step" onClick="history.go(-1)"/>
        </form>
    </div>
</div>
</body>
</html>
