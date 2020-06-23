<?php

class Location extends Model
{
    public $locations = array();
    private static $url = 'http://localhost/OBIS/REST/api/info/locatii/read.php';

    public function __construct()
    {
        $response = Model::getDataResponse(self::$url);
        $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($response), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "locatii") {
                array_push($this->locations, $val);
            }
        }
    }

    public function getData()
    {
        return $this->locations;
    }
}
