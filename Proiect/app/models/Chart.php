<?php

class Chart {

    public $dataResponse;
    public $date = array();
    public function __construct() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost/Proiect_5/rest/api/info/read.php?an=true',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $this->dataResponse = curl_exec($curl);
        curl_close($curl);

        $jsonIterator = new RecursiveIteratorIterator(
                        new RecursiveArrayIterator(
                            json_decode($this->dataResponse, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($jsonIterator as $key => $val) {
            if(!is_array($val) && $key ==='ani') {

                array_push($this->date, $val);

            }
        }

    }

    public function getData() {
        return $this->date;
    }
}
