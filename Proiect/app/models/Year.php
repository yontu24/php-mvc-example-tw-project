<?php

class Year extends Model
{
    public $years = array();
    private static $url = 'http://localhost/OBIS/REST/api/info/read.php?an=true';

    public function __construct()
    {
        $response = Model::getDataResponse(self::$url);
        $jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($response), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($jsonIterator as $key => $val) {
            if (!is_array($val) && $key === "ani") {
                array_push($this->years, $val);
            }
        }
    }

    public function getData()
    {
        return $this->years;
    }
}
