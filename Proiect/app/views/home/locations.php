<?php
$location = $data;

echo '<form action="Year" method="post">';
for ($i = 0; $i < count($location); $i++):
    echo '<input type="radio" name="' . $location[$i] . '" value="' . $location[$i] . '" /> ' . $location[$i] . '<br>';
endfor;
echo '<input type="submit" name="action" value="Submit">';
echo '</form>';




for ($i = 0; $i < count($location); $i++):
    if (isset($_POST[$location[$i]]))
        echo 'Ai apasat pe ' . $_POST[$location[$i]];
endfor;

?>
