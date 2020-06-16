<?php

class Location {

    public $dataResponse;
    public $locations = array();
    public function __construct() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost/OBIS/rest/api/info/read.php?locatie=true',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $this->dataResponse = curl_exec($curl);
        curl_close($curl);

        $jsonIterator = new RecursiveIteratorIterator(
                        new RecursiveArrayIterator(
                            json_decode($this->dataResponse, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
    
        foreach ($jsonIterator as $key => $val) {
            if(!is_array($val) && $key === "locatii") {
                array_push($this->locations, $val);
            }
        }
    }

    public function getData() {
        return $this->locations;
    }
}