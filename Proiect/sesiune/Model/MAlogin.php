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


if( !empty($data->username) && !empty($data->password) ){
 
    $query = "SELECT id, username, password FROM users WHERE username = :username;";
    $stmt = $db->prepare($query);
    $stmt->execute(["username" => $data->username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row == NULL){
        $user = array (
            "id" => $row['id'],
            "username" => $row['username'],
            "password" => $row['password']
        );
        if(password_verify($data->password,$user["password"])){
            $token = array(
                "iss" => JWT_ISS,
                "aud" => JWT_AUD,
                "iat" => JWT_IAT,
                "exp" => JWT_EXP,
                "data" => array(
                    "id" => $user["id"],
                    "username" => $user["username"]
                )
            );
            $jwt = JWT::encode($token,JWT_KEY);
            echo json_encode(["jwt"=>$jwt]);
        }else{
            http_response_code(401);
            echo json_encode(["message" => "Authentication failed"]);
        }
    }else{
        http_response_code(404);
        echo json_encode(["message" => "User not found"]);
    }
}
?>