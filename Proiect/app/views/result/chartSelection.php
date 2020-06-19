<?php
$locations = $data1;
$years = $data2;
$responses = $data3;
$categories = $data4;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Results</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/checkboxes.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/index.css">
    <link rel="icon" href="../../../public/icons/webicon.png" type="image/x-icon">
</head>
<body>
<div class="nav-bar">
    <!--        DE ADAUGAT DOCUMENTATIA -->
    <a class="item-home" href="index" title="Home">Press me</a>
    <a class="item-contact" href="#contact" title="Contact us">Press me</a>
    <a class="item-lang" href="#" title="Documentation">Press me</a>
    <style>.nav-bar{position: unset;}</style>
</div>
<div class="container">
    <h1>STEP 1</h1>
    <form action="../statistics/index" method="post">
        <div class="checkbox">
            <ul class="checkboxList">
                <li class="item">
                    <h1 class="filterTitle">Choose a Location</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($locations as $var):?>
                            <label class="checkbox-label">
                                <input type="checkbox"
                                       name=<?php echo str_replace(' ', '', $var) ?> value=<?php echo str_replace(' ', '', $var) ?>>
                                <span class="checkmark"></span>
                            </label> <?php echo $var ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="item">
                    <h1 class="filterTitle">Choose a Year</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($years as $year):?>
                            <label class="checkbox-label">
                                <input type="checkbox" name=<?= $year ?> value=<?= $year ?> >
                                <span class="checkmark"></span>
                            </label> <?php echo $year ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="item">
                    <h1 class="filterTitle">Choose weight category</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($responses as $response):
                            $cuv = explode(" ", $response[0]);?>
                            <label class="checkbox-label">
                                <input type="checkbox" name=<?= $cuv[0] ?> value=<?= $response[1] ?> >
                                <span class="checkmark"></span>
                            </label> <?php echo $response[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="item">
                    <h1 class="filterTitle">Choose weight category</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($categories as $category):?>
                            <label class="checkbox-label">
                                <input type="radio" name="filterCategory" value=<?=$category[1]?> checked >
                                <span class="checkmark"></span>
                            </label> <?php echo $category[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="item">
                    <h1 class="filterTitle">Choose a chart type</h1>
                    <div class="checkbox-container">

                        <input type="radio" name="filterChart" value='piechart' checked > PieChart <br>
                        <input type="radio" name="filterChart" value='linechart'  > LineChart <br>
                        <input type="radio" name="filterChart" value='barchart'  > BarChart <br>
                        
                    </div>
                </li>
            </ul>
        </div>
        <input type="submit" name="action" value="Submit">
    </form>
</div>
</body>
</html>
