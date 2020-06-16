<?php
$year = $data;

echo '<form action="chart" method="post">';
for ($i = 0; $i < count($year); $i++):
    echo '<input type="checkbox" name="' . $year[$i] . '" value="' . $year[$i] . '" /> ' . $year[$i] . '<br>';
endfor;
echo '<input type="submit" name="action" value="Submit">';
echo '</form>';




for ($i = 0; $i < count($year); $i++):
    if (isset($_POST[$year[$i]]))
        echo 'Ai apasat pe ' . $_POST[$year[$i]];
endfor;

?>
