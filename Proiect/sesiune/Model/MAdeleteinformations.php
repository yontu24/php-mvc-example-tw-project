<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../DB/database.php';
include_once '../JWT/jwt_params.php';
include_once '../JWT/php-jwt-master/src/BeforeValidException.php';
include_once '../JWT/php-jwt-master/src/ExpiredException.php';
include_once '../JWT/php-jwt-master/src/SignatureInvalidException.php';
include_once '../JWT/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;
 
$database = new Database();
$db = $database->getConnection();
 
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
    echo json_encode(["message" => "Authentication failed"]);
    exit();
}
if (!empty($data->an) && !empty($data->locatie) && !empty($data->categorie) && !empty($data->categorie_varsta)){
    $query = "DELETE FROM informations WHERE Autor = $user->id AND Year = :year AND Locationdesc = :locatie AND Response = :categorie AND BreakOutCategoryID = :categorie_varsta;";
    $stmt = $db->prepare($query);
    if($data->categorie == "obese"){
        $data->categorie = "Obese (BMI 30.0 - 99.8)";
    }else if($data->categorie == "overweight"){
        $data->categorie = "Overweight (BMI 25.0-29.9)";
    }else if($data->categorie == "normal"){
        $data->categorie = "Normal Weight (BMI 18.5-24.9)";
    }else if($data->categorie == "under"){
        $data->categorie = "Underweight (BMI 12.0-18.4)";
    }else {
        $data->categorie = "Obese (BMI 30.0 - 99.8)";
    }

    $insert_array = ["year" => $data->an,
                    "locatie" => $data->locatie,
                    "categorie" => $data->categorie,
                    "categorie_varsta" => $data->categorie_varsta
                    ];
    if($stmt->execute($insert_array)){ 
        http_response_code(201); //201 resource created
        echo json_encode(array("message" => "Information deleted"));
    }
    else{
        http_response_code(503); // 503 service u
        echo json_encode(array("message" => "Unable to delete information"));
    }
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Wrong parameters (ex: jwt, an, locatie, categorie(obese,overweight,normal,under), categorie_varsta (CAT1-6)"));
}

?>