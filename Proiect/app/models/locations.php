<html>
<?php
$locations=$data1;
$years=$data2;


echo '<form action="test" method="post">';
foreach($locations as $var):
    if($var=='Florida'){?>
<input type="checkbox" name=<?=$var?> value=<?=$var?> checked > <?php echo $var?> <br>
<?php } else {?>
  <input type="checkbox" name=<?php echo str_replace(' ', '',$var)?> value=<?php echo str_replace(' ', '',$var)?> > <?php echo $var?> <br>
<?php }endforeach;?>
<br><br>
<?php
foreach($years as $var):
    if($var=='2011'){?>
<input type="checkbox" name=<?=$var?> value=<?=$var?> checked > <?php echo $var?> <br>
<?php } else {?>
  <input type="checkbox" name=<?=$var?> value=<?=$var?> > <?php echo $var?> <br>
<?php }endforeach;?>
<input type="submit" name="action" value="Submit">
</form>

</html>
