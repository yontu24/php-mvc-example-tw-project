<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Info.php';

$database = new Database();
$db = $database->getConnection();

$info = new Info($db);

if(isset($_GET['an'])){
    $info->an = explode(',',$_GET['an']);
} else{
    $info->an = null;
}
if(isset($_GET['locatie'])){
    $aux = str_replace('_', ' ',$_GET['locatie']);
    $info->locatie = explode(',',$aux);
} else{
    $info->locatie = null;
}
if(isset($_GET['raspuns'])){
    $info->id_raspuns = explode(',',$_GET['raspuns']);
} else{
    $info->id_raspuns = null;
}
if(isset($_GET['categorie'])){
    $info->id_categorie = $_GET['categorie'];
} else{
    $info->id_categorie = null;
}

if($info->an != null && $info->locatie != null && $info->id_raspuns != null && $info->id_categorie != null){
    $info_arr = array("count" =>" informatii");
    $info_arr["values"] = array();
    $prima_data = true;

    foreach($info->an as $ani){
        foreach($info->locatie as $locatii){
            foreach($info->id_raspuns as $raspunsuri){
                $result = $info->read($ani,$locatii,$raspunsuri,$info->id_categorie);

                $num = $result->rowCount();

                if($num > 0){
                    $contor = 0;
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                        if($prima_data){
                            $info_aux = array("break_out" => $row['Break_Out'], "cazuri" => $row['Sample_Size']);
                            array_push($info_arr["values"], $info_aux);
                        }else{
                            $info_arr['values'][$contor]['cazuri'] = $info_arr['values'][$contor]['cazuri'] + $row['Sample_Size'];
                            $contor++;
                        }
                    }
                    $prima_data = false;
                }
            }
        }
    }
    http_response_code(200);
    echo json_encode($info_arr);
} else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No informations")
    );

}
?>