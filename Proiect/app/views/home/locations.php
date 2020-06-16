<?php
$location = $data;

echo '<form action="#" method="post">';
for ($i = 0; $i < count($location); $i++):
    echo '<input type="radio" name="_loc[]" value="' . $i . '" /> ' . $location[$i] . '<br>';
endfor;
echo '<input type="submit" name="action" value="Submit">';
echo '</form>';
?>