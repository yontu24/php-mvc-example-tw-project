<?php

class Test {

  public $dataResponse1;
  public $dataResponse2;
  public $dataResponse3;
  public $dataResponse4;
  public $locations = array();
  public $years = array();
  public $response=array();
  public $data = array();
  public function __construct() {

    //----------------------------------------------------------------------curl pentru locatii
    $curl1 = curl_init();

    curl_setopt_array($curl1, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'http://localhost/Proiect_5/rest/api/info/read.php?locatie=true',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ]);

    $this->dataResponse1 = curl_exec($curl1);
    curl_close($curl1);

    $jsonIterator = new RecursiveIteratorIterator(
      new RecursiveArrayIterator(
        json_decode($this->dataResponse1, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
          if(!is_array($val) && $key === "locatii") {
            array_push($this->locations, $val);
          }
        }

        //-------------------------------------------------------------------------------------curl pentru ani
        $curl2 = curl_init();

        curl_setopt_array($curl2, [
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => 'http://localhost/Proiect_5/rest/api/info/read.php?an=true',
          CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $this->dataResponse2 = curl_exec($curl2);
        curl_close($curl2);

        $jsonIterator = new RecursiveIteratorIterator(
          new RecursiveArrayIterator(
            json_decode($this->dataResponse2, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($jsonIterator as $key => $val) {
              if(!is_array($val) && $key === "ani") {
                array_push($this->years, $val);
              }
            }
//-------------------------------------------------curl pentru raspuns(categorii de greutate)
$curl4 = curl_init();

curl_setopt_array($curl4, [
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => 'http://localhost/Proiect_5/rest/api/info/read.php?raspuns=true',
  CURLOPT_USERAGENT => 'Codular Sample cURL Request'
]);

$this->dataResponse4 = curl_exec($curl4);
curl_close($curl4);

$jsonIterator = new RecursiveIteratorIterator(
  new RecursiveArrayIterator(
    json_decode($this->dataResponse4, TRUE)), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($jsonIterator as $key => $val) {
      if(!is_array($val) && $key === "raspuns") {
        array_push($this->response, $val);
      }
    }
            //-------------------------------------------------------------------------------------curl pentru datele pe care o sa le transmit

            $paramLoc=[];
            foreach($this->locations as $var):
              if (isset($_POST[str_replace(' ', '',$var)]))
              array_push($paramLoc,str_replace(' ','_',$var));
              //echo getType($var);
              //echo $var;
              //echo $_POST[str_replace(' ', '',$var)];
            endforeach;

            $paramAn=[];
            foreach($this->years as $var):
              if (isset($_POST[$var]))
              //print_r($var);
              //echo ($_POST[$var]);
              array_push($paramAn,$_POST[$var]);
            endforeach;

            $paramR=[];
            foreach($this->response as $var):
              if (isset($_POST[$var]))
              //print_r($var);
              echo ($_POST[$var]);
              array_push($paramAn,$_POST[$var]);
            endforeach;
            ?>
            <script type= text/javascript >localStorage.setItem('location','<?php echo str_replace('_',' ',$paramLoc[0])?>');
              localStorage.setItem('year','<?php echo $paramAn[0]?>')
             </script>
            <?php
            $curl3 = curl_init();

            $url="http://localhost/Proiect_5/rest/api/info/read.php?an={$paramAn[0]}&locatie={$paramLoc[0]}&raspuns=RESP040&categorie=CAT4";
            //"http://localhost/Proiect_5/rest/api/info/read.php?an=2018&locatie=Connecticut&raspuns=RESP040&categorie=CAT4"

            curl_setopt_array($curl3, [
              CURLOPT_RETURNTRANSFER => 1,
              CURLOPT_URL => $url,
              CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ]);

            $this->dataResponse3 = curl_exec($curl3);
            curl_close($curl3);


            $arr =json_decode($this->dataResponse3,TRUE);


            for($i=0;$i<count($arr['values']);$i++)
            {
              array_push($this->data,[[$arr['values'][$i]['break_out']],[$arr['values'][$i]['cazuri']]]);}


            }

            public function getData() {

              return $this->data;
            }
          }
