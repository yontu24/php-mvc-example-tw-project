<html>
<?php
require_once "Optiuni.php";



echo '<form action="test" method="post">';
foreach($locations as $var):
    if($var=='Florida'){?>
<input type="checkbox" name=<?=$var?> value=<?=$var?> checked > <?php echo $var?> <br>
<?php } else {?>
  <input type="checkbox" name=<?=$var?> value=<?=$var?> > <?php echo $var?> <br>
<?php }endforeach;
echo '<input type="submit" name="action" value="Submit">';
echo '</form>';




foreach($locations as $var):
    if (isset($_POST[$var]))
        echo 'Ai apasat pe ' . $_POST[$var];
endforeach;

?>
</html>
