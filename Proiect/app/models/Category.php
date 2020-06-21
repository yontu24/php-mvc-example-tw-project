<?php

class Category extends Model
{
    public $data = array();
    private static $url = 'http://localhost/OBIS/REST/api/info/read.php?categorie=true';

    public function __construct()
    {
        $response = Model::getDataResponse(self::$url);

        for ($i = 0; $i < count($response['values']); $i++) {
            array_push($this->data, [$response['values'][$i]['categorii'], $response['values'][$i]['id']]);
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
