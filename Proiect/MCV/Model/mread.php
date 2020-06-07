<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../DB/database.php';

$database = new Database();
$db = $database->getConnection(); 

$data = json_decode(file_get_contents("php://input"));

if( !empty($data->locatie) && !empty($data->categorie) && !empty($data->raspuns) )
{
    $query = "SELECT distinct * FROM informations WHERE Locationdesc = :locatie and Break_Out_Category = :categorie and Response = :raspuns ORDER by BreakoutID , Year;";
    $stmt = $db->prepare($query);

    $insert_array = ["locatie" => $data->locatie, 
                     "categorie" => $data->categorie,
                     "raspuns" => $data->raspuns
                    ];
    if($stmt->execute($insert_array)){ 
        http_response_code(200);
        echo json_encode($stmt->fetchAll());
        //echo json_encode(array("message" => "Contact added."));
    }
    else{
        http_response_code(404);
        echo json_encode(array("message" => "Unable to find result"));
    }
}
else{
    http_response_code(400); // bad request
    echo json_encode(array("message" => " Parametrii invalizi ".$data->locatie.", ".$data->categorie.", ".$data->raspuns));
}
?>