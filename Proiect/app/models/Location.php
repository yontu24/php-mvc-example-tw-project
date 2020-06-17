<?php

class Location {

  public $dataResponse;
  public $locations = array();
  public function __construct() {
    require_once "OptiuniModele.php";
    $param=[];
    foreach($locations as $var):
      if (isset($_POST[$var]))
      array_push($param,$_POST[$var]);
    endforeach;


    $curl = curl_init();

    $url="http://localhost/Proiect_5/rest/api/info/read.php?an=2018&locatie={$param[0]}&raspuns=RESP040&categorie=CAT4";
    //"http://localhost/Proiect_5/rest/api/info/read.php?an=2018&locatie=Connecticut&raspuns=RESP040&categorie=CAT4"

    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ]);

    $this->dataResponse = curl_exec($curl);
    curl_close($curl);


        $arr =json_decode($this->dataResponse,TRUE);

      
        for($i=0;$i<count($arr['values']);$i++)
          {
          array_push($this->locations,[[$arr['values'][$i]['break_out']],[$arr['values'][$i]['cazuri']]]);}


      }

      public function getData() {

        return $this->locations;
      }
    }
