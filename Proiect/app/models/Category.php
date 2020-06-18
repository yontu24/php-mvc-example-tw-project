<?php

class Category {

  public $dataResponse;
  public $category = array();
  public $data = array();
  public function __construct() {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'http://localhost/Proiect_5/rest/api/info/read.php?categorie=true',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ]);

    $this->dataResponse = curl_exec($curl);
    curl_close($curl);


    $arr =json_decode($this->dataResponse,TRUE);


    for($i=0;$i<count($arr['values']);$i++)
    {
      array_push($this->data,[$arr['values'][$i]['categorii'],$arr['values'][$i]['id']]);}


    }

    public function getData() {
      
      return $this->data;
    }
  }
