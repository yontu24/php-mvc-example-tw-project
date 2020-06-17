<?php
require_once "Optiuni.php";



echo '<form action="#" method="post">';
foreach($locations as $var):
    echo '<input type="radio" name="' . $var . '" value="' . $var . '" /> ' . $var . '<br>';
endforeach;
echo '<input type="submit" name="action" value="Submit">';
echo '</form>';




foreach($locations as $var):
    if (isset($_POST[$var]))
        echo 'Ai apasat pe ' . $_POST[$var];
endforeach;

?>
