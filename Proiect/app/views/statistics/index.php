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
    <title>Statistics</title>


    <!--    ultima modificare aici-->


    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/checkboxes_compare.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/OBIS/public/style/index.css">
    <link rel="icon" href="../../../public/icons/webicon.png" type="image/x-icon">
    <style>.nav-bar {
            position: unset;
        }</style>
</head>
<body>
<div class="nav-bar">
    <a class="item-home" href="../../public/home/index/" title="Home">Press me</a>
    <a class="item-lang" href="#" title="Documentation">Press me</a>
</div>
<div class="container">
    <div class="stepText">
        <img id="s1img" src="../../public/icons/thirdStep.jpg" alt="">
        <br><br>
        Check the filters you want to apply to the data rendered on the chart from bellow.<br><br>
        You can also choose multiple options from the same filter.<br><br>
    </div>
    <form action="stats" method="post">
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
                    <h1 class="filterTitle">Choose weight category</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($responses as $response):
                            $cuv = explode(" ", $response[0]); ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name=<?= $cuv[0] ?> value=<?= $response[1] ?> >
                                <span class="checkmark"></span>
                            </label> <?php echo $response[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </div>

        <div class="checkbox">
            <ul class="checkboxList">
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
                    <h1 class="filterTitle">Choose a breakout category</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($categories as $category):?>
                            <label class="checkbox-label">
                                <input type="radio" name="filterCategory" value=<?= $category[1] ?> checked>
                                <span class="checkmark"></span>
                            </label> <?php echo $category[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="submit2">
            <input class="submit" type="submit" name="action" value="Submit">
        </div>
    </form>
    <br><br>
    <div class="stepText">
        Want to modify your choices?<br>
        <form>
            <input type="button" class="submit" value="Return to previous step" onClick="history.go(-1)"/>
        </form>
    </div>
</div>
</body>
</html>
