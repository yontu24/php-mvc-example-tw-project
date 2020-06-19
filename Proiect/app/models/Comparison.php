<?php

class Comparison
{
    public $data = array();
    public $finalData = array();

    public function __construct()
    {
        $paramLoc1 = isset($_POST['filterFirstLocation']) ? $_POST['filterFirstLocation'] : 'Florida';
        $paramLoc2 = isset($_POST['filterSecondLocation']) ? $_POST['filterSecondLocation'] : 'Nevada';
        $paramYear1 = isset($_POST['filterFirstYear']) ? $_POST['filterFirstYear'] : '2011';
        $paramYear2 = isset($_POST['filterSecondYear']) ? $_POST['filterSecondYear'] : '2018';
        $paramRes1 = isset($_POST['filterFirstResponse']) ? $_POST['filterFirstResponse'] : 'Obese (BMI 30.0 - 99.8)';
        $paramRes2 = isset($_POST['filterSecondResponse']) ? $_POST['filterSecondResponse'] : 'Obese (BMI 30.0 - 99.8)';
        $paramCat = isset($_POST['filterCategory']) ? $_POST['filterCategory'] : 'Age Group';

        /*if (strpos($paramLoc1, '_')) {
            $paramLoc1 = str_replace('_', ' ', $paramLoc1);
        }

        if (strpos($paramLoc2, '_')) {
            $paramLoc2 = str_replace('_', ' ', $paramLoc2);
        }*/

        ?>
        <script type=text/javascript>
            localStorage.setItem('firstLocation', '<?php echo str_replace('_', ' ', $paramLoc1)?>');
            localStorage.setItem('firstYear', '<?php echo $paramYear1?>');
            localStorage.setItem('firstResponse', '<?php echo $paramRes1?>');
            localStorage.setItem('secondLocation', '<?php echo str_replace('_', ' ', $paramLoc2)?>');
            localStorage.setItem('secondYear', '<?php echo $paramYear2?>');
            localStorage.setItem('secondResponse', '<?php echo $paramRes2?>');
            localStorage.setItem('category', '<?php echo $paramCat?>');
        </script>
        <?php

        $url = "http://localhost/obis/rest/api/info/read.php?an={$paramYear1}&locatie={$paramLoc1}&raspuns={$paramRes1}&categorie={$paramCat}";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $dataResponse = curl_exec($curl);
        curl_close($curl);

        $arrdata = json_decode($dataResponse, TRUE);

        for ($i = 0; $i < count($arrdata['values']); $i++)
        {
            array_push($this->data, [
                $arrdata['values'][$i]['break_out'],
                $arrdata['values'][$i]['cazuri']
            ]);
        }

        array_push($this->finalData, $this->data);
        $this->data = array();

        $url = "http://localhost/obis/rest/api/info/read.php?an={$paramYear2}&locatie={$paramLoc2}&raspuns={$paramRes2}&categorie={$paramCat}";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $dataResponse = curl_exec($curl);
        curl_close($curl);

        $arrdata = json_decode($dataResponse, TRUE);

        for ($i = 0; $i < count($arrdata['values']); $i++)
        {
            array_push($this->data, [
                $arrdata['values'][$i]['break_out'],
                $arrdata['values'][$i]['cazuri']
            ]);
        }
        array_push($this->finalData, $this->data);
    }

    public function getData()
    {
        return $this->finalData;
    }
}