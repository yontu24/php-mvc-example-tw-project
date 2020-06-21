<?php

class Comparison extends Model
{
    public $data = array();
    public $finalData = array();

    public function __construct()
    {
        /////////////////////////////////////////////////////////////////
        ///////////////////////// GET LOCATIONS /////////////////////////
        /////////////////////////////////////////////////////////////////

        $url = 'http://localhost/OBIS/REST/api/info/read.php?locatie=true';
        $dataResponse = Model::getDataResponse($url);
        $locations = new RecursiveIteratorIterator(new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        $paramLoc1 = '';
        $paramLoc2 = '';

        foreach ($locations as $key => $val):
            if (!is_array($val) && $key === "locatii") {
                $location = str_replace(' ', '_', $val);

                if (isset($_POST['location#1'][$val])) {
                    $paramLoc1 .= ($paramLoc1 == NULL) ? $location : (',' . $location);
                }

                if (isset($_POST['location#2'][$val])) {
                    $paramLoc2 .= ($paramLoc2 == NULL) ? $location : (',' . $location);
                }
            }
        endforeach;

        if ($paramLoc1 === '')
            $paramLoc1 = 'Florida';
        if ($paramLoc2 === '')
            $paramLoc2 = 'Nevada';

        /////////////////////////////////////////////////////////////////
        /////////////////////////// GET YEARS ///////////////////////////
        /////////////////////////////////////////////////////////////////

        $url = 'http://localhost/OBIS/REST/api/info/read.php?an=true';
        $dataResponse = Model::getDataResponse($url);
        $years = new RecursiveIteratorIterator(new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        $paramYear1 = '';
        $paramYear2 = '';

        foreach ($years as $key => $val):
            if (!is_array($val) && $key === "ani") {
                $year = str_replace(' ', '_', $val);

                if (isset($_POST['year#1'][$val])) {
                    $paramYear1 .= ($paramYear1 == NULL) ? $year : (',' . $year);
                }

                if (isset($_POST['year#2'][$val])) {
                    $paramYear2 .= ($paramYear2 == NULL) ? $year : (',' . $year);
                }
            }
        endforeach;

        if ($paramYear1 === '')
            $paramYear1 = '2017';
        if ($paramYear2 === '')
            $paramYear2 = '2017';

        $paramRes1 = isset($_POST['filterFirstResponse']) ? $_POST['filterFirstResponse'] : 'RESP040';
        $paramRes2 = isset($_POST['filterSecondResponse']) ? $_POST['filterSecondResponse'] : 'RESP039';
        $paramCat = isset($_POST['filterCategory']) ? $_POST['filterCategory'] : 'CAT3';

        ?>
        <script type=text/javascript>
            localStorage.setItem('firstLocation', '<?php echo str_replace(['_', ','], [' ', ', '], $paramLoc1)?>');
            localStorage.setItem('firstYear', '<?php echo str_replace(',', ', ', $paramYear1)?>');
            localStorage.setItem('firstResponse', '<?php echo $paramRes1?>');
            localStorage.setItem('secondLocation', '<?php echo str_replace(['_', ','], [' ', ', '], $paramLoc2)?>');
            localStorage.setItem('secondYear', '<?php echo str_replace(',', ', ', $paramYear2)?>');
            localStorage.setItem('secondResponse', '<?php echo $paramRes2?>');
            localStorage.setItem('category', '<?php echo $paramCat?>');
        </script>
        <?php

        /////////////////////////////////////////////////////////////////
        //////////////////// GET DATA BY USER CHOICES ///////////////////
        /////////////////////////////////////////////////////////////////

        $url = "http://localhost/OBIS/REST/api/info/read.php?an={$paramYear1}&locatie={$paramLoc1}&raspuns={$paramRes1}&categorie={$paramCat}";
        $dataResponse = Model::getDataResponse($url);

        for ($i = 0; $i < count($dataResponse['values']); $i++) {
            array_push($this->data, [
                $dataResponse['values'][$i]['break_out'],
                $dataResponse['values'][$i]['cazuri']
            ]);
        }

        array_push($this->finalData, $this->data);
        $this->data = array();  // BUG FIX

        $url = "http://localhost/OBIS/REST/api/info/read.php?an={$paramYear2}&locatie={$paramLoc2}&raspuns={$paramRes2}&categorie={$paramCat}";
        $dataResponse = Model::getDataResponse($url);

        for ($i = 0; $i < count($dataResponse['values']); $i++) {
            array_push($this->data, [
                $dataResponse['values'][$i]['break_out'],
                $dataResponse['values'][$i]['cazuri']
            ]);
        }
        array_push($this->finalData, $this->data);
    }

    public function getData()
    {
        return $this->finalData;
    }
}