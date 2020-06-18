<html>
<?php
$locations=$data1;
$years=$data2;
$response=$data3;
$category=$data4;
echo '<form action="test" method="post">';
//---------------------------checkboxuri locatii
foreach($locations as $var):
    if($var=='Florida'){?>
<input type="checkbox" name=<?=$var?> value=<?=$var?> checked > <?php echo $var?> <br>
<?php } else {?>
  <input type="checkbox" name=<?php echo str_replace(' ', '',$var)?> value=<?php echo str_replace(' ', '',$var)?> > <?php echo $var?> <br>
<?php }endforeach;?>
<br><br>
<?php
//---------------------------checkboxuri ani
foreach($years as $var):
    if($var=='2011'){?>
<input type="checkbox" name=<?=$var?> value=<?=$var?> checked > <?php echo $var?> <br>
<?php } else {?>
  <input type="checkbox" name=<?=$var?> value=<?=$var?> > <?php echo $var?> <br>
<?php }endforeach;?>
<br><br>
<?php
//---------------------------checkboxuri raspuns(categorii de greutate)

foreach($response as $var):
  $cuv=explode(" ",$var[0]);
    if($var[0]=='Obese (BMI 30.0 - 99.8)'){?>
<input type="checkbox" name=<?=$cuv[0]?> value=<?=$var[1]?> checked > <?php echo $var[0]?> <br>
<?php } else {?>
  <input type="checkbox" name=<?=$cuv[0]?> value=<?=$var[1]?>  > <?php echo $var[0]?> <br>
<?php }endforeach;?>
<br><br>

<?php
//---------------------------radio categorii (age group,overall,education etc)
foreach($category as $var):
  ?>
  <input type="radio" name="filterCategory" value=<?=$var[1]?> checked > <?php echo $var[0]?> <br>
<?php endforeach;?>
<br><br>
<?php
//---------------------------radio categorii (age group,overall,education etc)

  ?>
  <input type="radio" name="filterChart" value='piechart' checked > PieChart <br>
  <input type="radio" name="filterChart" value='linechart'  > LineChart <br>
  <input type="radio" name="filterChart" value='barchart'  > BarChart <br>
  
<br><br>
<input type="submit" name="action" value="Submit">
</form>

</html>
