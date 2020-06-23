<?php

class AllFilters extends Model
{
    public $locations = array();
    public $years = array();
    public $response = array();
    public $category = array();
    public $data = array();

    public function __construct()
    {
        //----------------------------------------------------------------------curl pentru locatii
        $url = 'http://localhost/OBIS/REST/api/info/locatii/read.php';
        $dataResponse = Model::getDataResponse($url);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "locatii") {
                array_push($this->locations, $val);
            }
        }
        //-------------------------------------------------------------------------------------curl pentru ani
        $url = 'http://localhost/OBIS/REST/api/info/ani/read.php';
        $dataResponse = Model::getDataResponse($url);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "ani") {
                array_push($this->years, $val);
            }
        }
        //-------------------------------------------------curl pentru raspuns(categorii de greutate)
        $url = 'http://localhost/OBIS/REST/api/info/raspunsuri/read.php';
        $dataResponse = Model::getDataResponse($url);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "raspuns") {
                array_push($this->response, $val);
            }
        }
        //----------------------------------------------------------------curl pentru categorii(educatie,gender,etc)
        $url = 'http://localhost/OBIS/REST/api/info/categorii/read.php';
        $dataResponse = Model::getDataResponse($url);

        $jsonIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($dataResponse), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "categorii") {
                array_push($this->category, $val);
            }
        }
        //-------------------------------------------------------------------------------------curl pentru datele pe care o sa le transmit

        $paramLoc = '';
        foreach ($this->locations as $var):
            if (isset($_POST[str_replace(' ', '', $var)]))
                //array_push($paramLoc,str_replace(' ','_',$var));

                if ($paramLoc == NULL) {
                    $paramLoc .= str_replace(' ', '_', $var);
                } else {
                    $paramLoc .= ',' . str_replace(' ', '_', $var);
                }
        endforeach;
        if ($paramLoc == NULL) {
            $paramLoc = 'Alabama';
        }
        $paramAn = '';
        foreach ($this->years as $var):
            if (isset($_POST[$var]))
                //print_r($var);
                //echo ($_POST[$var]);
                //array_push($paramAn,$_POST[$var]);
                if ($paramAn == NULL) {
                    $paramAn .= $_POST[$var];
                } else {
                    $paramAn .= ',' . $_POST[$var];
                }
        endforeach;
        if ($paramAn == NULL) {
            $paramAn = '2011';
        }
        //echo $paramAn;
        $paramR = '';
        $paramR1 = '';
        foreach ($this->response as $var):
            $cuv = explode(" ", $var);
            if (isset($_POST[$cuv[0]]))
                if ($paramR == NULL) {
                    $paramR .= $_POST[$cuv[0]];
                    $paramR1 .= $cuv[0];
                } else {
                    $paramR .= ',' . $_POST[$cuv[0]];
                    $paramR1 .= $cuv[0];
                }
            //array_push($paramR,$_POST[$cuv[0]]);
        endforeach;
        if ($paramR == NULL) {
            $paramR = 'RESP039';
        }
        if ($paramR1 == NULL) {
            $paramR1 = 'Obese';
        }
        $paramC = 'CAT4';
        if (isset($_POST['filterCategory'])) {
            $paramC = $_POST['filterCategory'];
        }

        //echo $paramC;

        ?>
        <script type=text/javascript>
            localStorage.setItem('location', '<?php echo str_replace('_', ' ', $paramLoc)?>');
            localStorage.setItem('year', '<?php echo $paramAn?>');
            localStorage.setItem('response', '<?php echo $paramR1?>');
        </script>
        <?php

        $url = "http://localhost/OBIS/REST/api/info/read.php?an={$paramAn}&locatie={$paramLoc}&raspuns={$paramR}&categorie={$paramC}";
        //"http://localhost/obis/rest/api/info/read.php?an=2018&locatie=Connecticut&raspuns=RESP040&categorie=CAT4"

        $arr = Model::getDataResponse($url);
        for ($i = 0; $i < count($arr['values']); $i++) {
            array_push($this->data, [[$arr['values'][$i]['break_out']], [$arr['values'][$i]['cazuri']]]);
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
