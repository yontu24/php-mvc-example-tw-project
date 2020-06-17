<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Info.php';

include_once '../../config/JWT/jwt_params.php';
include_once '../../config/JWT/php-jwt-master/src/BeforeValidException.php';
include_once '../../config/JWT/php-jwt-master/src/ExpiredException.php';
include_once '../../config/JWT/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../config/JWT/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;
 
$database = new Database();
$db = $database->getConnection();

$info = new Info($db);
 
$data = json_decode(file_get_contents("php://input"));

$user = NULL;

if (!empty($data->jwt)){
    try{
        $decoded_jwt = JWT::decode($data->jwt, JWT_KEY, array("HS256"));
        $user = $decoded_jwt->data;
    }
    catch(Exception $e){
        http_response_code(401);
        echo json_encode(["message" => $e->getMessage()]);
        exit();
    }
}else{
    echo json_encode(["message" => "Authentication failed! JWT missing"]);
    exit();
}
if (!empty($data->an) && !empty($data->locatie)  && !empty($data->break_out) && !empty($data->nr_cazuri) && !empty($data->id_break_out)  && !empty($data->id_categorie)  && !empty($data->id_raspuns)){
    $info->an = $data->an;
    $info->locatie = $data->locatie;
    $info->break_out = $data->break_out;
    $info->nr_cazuri = $data->nr_cazuri;
    $info->id_break_out = $data->id_break_out;
    $info->id_categorie = $data->id_categorie;
    $info->id_raspuns = $data->id_raspuns;

    if($info->delete()){ 
        http_response_code(200);
        echo json_encode(array("message" => "Information deleted"));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete information"));
    }
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Wrong parameters (ex: jwt, an, locatie, break_out, categorie(CAT1-6), nr_cazuri, id_break_out, id_categorie, id_raspuns(RESP039-42)"));
}

?>