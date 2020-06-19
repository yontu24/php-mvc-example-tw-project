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
    <title>Comparison</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../public/icons/webicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="http://localhost/obis/public/style/checkboxes_compare.css">
</head>
<body>
<div class="container">
    <h1>STEP 1</h1>
    <form action="../comparisons/stats" method="post">
        <div class="checkbox checkbox_firstFilter">
            <h2>Choose first filter</h2>
            <ul class="checkboxList">
                <li class="item">
                    <h1 class="filterTitle">Choose a Location</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($locations as $var):?>
                            <label class="checkbox-label">
                                <input type="radio"
                                       name="filterFirstLocation" value=<?php echo str_replace(' ', '_', $var) ?>>
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
                                <input type="radio" name="filterFirstYear" value=<?= $year ?>>
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
                            $cuv = explode(" ", $response[0]); ?>
                            <label class="checkbox-label">
                                <input type="radio" name="filterFirstResponse" value=<?= $response[1] ?>>
                                <span class="checkmark"></span>
                            </label> <?php echo $response[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </div>

        <div class="checkbox checkbox_secondFilter">
            <h2>Choose first filter</h2>
            <ul class="checkboxList">
                <li class="item">
                    <h1 class="filterTitle">Choose a Location</h1>
                    <div class="checkbox-container">
                        <?php
                        foreach ($locations as $var):?>
                            <label class="checkbox-label">
                                <input type="radio"
                                       name="filterSecondLocation" value=<?php echo str_replace(' ', '_', $var) ?>>
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
                                <input type="radio" name="filterSecondYear" value=<?= $year ?>>
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
                            $cuv = explode(" ", $response[0]); ?>
                            <label class="checkbox-label">
                                <input type="radio" name="filterSecondResponse" value=<?= $response[1] ?>>
                                <span class="checkmark"></span>
                            </label> <?php echo $response[0] ?> <br>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </div>

        <div class="checkbox-category">
            <ul class="checkboxList">
                <li class="item">
                    <h1 class="filterTitle">Render by</h1>
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
        <input type="submit" name="action" value="Submit">
    </form>
</div>
</body>
</html>