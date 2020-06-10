<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://localhost/TW/Proiect_TW/Model/mgetlocations.php'
            ]);
            $result = curl_exec($curl);
            $date = json_decode($result);

            for ($i = 0;$i< count($date->values);$i++)
            {
                echo $date->values[$i]->Locationdesc;
                echo " <br/> ";
            }
    // class CGetLocations
    // {
    //     private $data;
    //     public function __construct()
    //     {
    //         $this->getInformatii();
    //         $this->afiseazaInformatii();
    //     }

    //     private function getInformatii(){
    //         $curl = curl_init();
    //         curl_setopt_array($curl, [
    //             CURLOPT_RETURNTRANSFER => 1,
    //             CURLOPT_URL => 'http://localhost/TW/Proiect_TW/Model/mgetlocations.php'
    //         ]);
    //         $result = curl_exec($curl);
    //         $date = json_decode($result);

    //         for ($i = 0;$i< count($date->values);$i++)
    //         {
    //             echo $date->values[$i]->Locationdesc;
    //             echo " <br/> ";
    //         }
    //     }

    //     private function afiseazaInformatii(){
    //         $informatii = $this->model->getInformatii('Puerto Rico','Age Group','Obese (BMI 30.0 - 99.8)');
    //         $view = new VInformatii();
    //         $view -> incarcaDatele($informatii);
    //         echo $view -> oferaVizualizare();
    //     }
    // }

?>