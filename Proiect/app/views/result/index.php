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

    <div class="stepText">
      <img id="s1img" src="../../public/icons/firstStep.jpg">
     <br><br>
      Choose the type of data representation to be rendered.<br><br>
      The statistics display sumed up data for the chosen filters.<br><br>
      The comparisons display data for the two sets of chosen filters, in relation to eachother.<br><br>
<br><br>
    <form action="formularTip" method="post">



        <div class="CorS">  <img src="../../public/icons/comparisons.png" class="checkImg">  <input type="radio" name="filterAction" value='comparison'  checked > Comparison <br></div>
        <br><br>
        <div class="CorS">  <img src="../../public/icons/statistics.png" class="checkImg">  <input type="radio" name="filterAction" value='statistics'  > Statistics <br></div>


        <input type="submit" name="action" value="Submit" class="submit">

    </form>
    </div>
</div>

</body>
</html>
