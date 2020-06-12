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

$query = "SELECT Year, Locationdesc, Response, Sample_Size, BreakOutCategoryID FROM informations WHERE Autor = :Autor";
$stmt = $db->prepare($query);
$stmt->execute(["Autor" => $user->id]);  

$num = $stmt->rowCount();

if($num>0){
    $contacts_arr=array("No values" => $num. " informations");
    $contacts_arr["data"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $contact=array(
            "an" => $row['Year'],
            "locatie" => $row['Locationdesc'],
            "categorie" => $row['Response'],
            "nr_cazuri" => $row['Sample_Size'],
            "categorie_varsta" => $row['BreakOutCategoryID']
        ); 
        array_push($contacts_arr["data"], $contact);
    }
    http_response_code(200);
    echo json_encode($contacts_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No Data")
    );
}
?>