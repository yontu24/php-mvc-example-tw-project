<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../DB/database.php';
 
$database = new Database();
$db = $database->getConnection();
 
$data = json_decode(file_get_contents("php://input"));


if( !empty($data->username) && !empty($data->password) ){
 
    $query = "INSERT INTO users (username, password) VALUES (:username, :password);";
    $stmt = $db->prepare($query);
    $password = password_hash($data->password, PASSWORD_BCRYPT);

    $insert_array = ["username" => $data->username,"password" => $password];
    if($stmt->execute($insert_array)){ 
        http_response_code(201); //201 resource created
        echo json_encode(array("message" => "User added"));
    }
    else{
        http_response_code(503); // 503 service u
        echo json_encode(array("message" => "Can't add user"));
    }
}
else{
    http_response_code(400); // bad request
    echo json_encode(array("message" => "Unable to create contact. Need more data"));
}
?>