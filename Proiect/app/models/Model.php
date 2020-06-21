<?php


class Model
{
    public static function getDataResponse($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response,TRUE);
    }
}