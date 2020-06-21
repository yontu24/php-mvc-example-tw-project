<?php

class Response extends Model
{
    public $response = array();
    public $data = array();
    private static $url = 'http://localhost/OBIS/REST/api/info/read.php?raspuns=true';

    public function __construct()
    {
        $response = Model::getDataResponse(self::$url);

        for ($i = 0; $i < count($response['values']); $i++) {
            array_push($this->data, [$response['values'][$i]['raspuns'], $response['values'][$i]['id']]);
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
