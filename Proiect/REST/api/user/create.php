<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/User.php';

include_once '../../config/JWT/jwt_params.php';
include_once '../../config/JWT/php-jwt-master/src/BeforeValidException.php';
include_once '../../config/JWT/php-jwt-master/src/ExpiredException.php';
include_once '../../config/JWT/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../config/JWT/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;
 
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
 
$data = json_decode(file_get_contents("php://input"));

if( !empty($data->username) && !empty($data->password) ){
    $user->username = $data->username;
    $user->password = password_hash($data->password, PASSWORD_BCRYPT);

    if($user->create()){ 
        http_response_code(201);
        echo json_encode(array("message" => "User added"));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Can't add user"));
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create contact. Need more data"));
}

?>