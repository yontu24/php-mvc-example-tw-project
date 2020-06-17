<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

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
 
if(isset($_GET['username']) && isset($_GET['password'])){
    $user->username = $_GET['username'];
    $user->password = $_GET['password'];
} else{
    die();
}

$row = $user->read()->fetch(PDO::FETCH_ASSOC);
if (!$row == NULL){
    $current_user = array (
        "id" => $row['id'],
        "username" => $row['username'],
        "password" => $row['password']
    );
    if(password_verify($user->password,$current_user["password"])){
        $token = array(
            "iss" => JWT_ISS,
            "aud" => JWT_AUD,
            "iat" => JWT_IAT,
            "exp" => JWT_EXP,
            "data" => array(
                "id" => $current_user["id"],
                "username" => $current_user["username"]
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
?>