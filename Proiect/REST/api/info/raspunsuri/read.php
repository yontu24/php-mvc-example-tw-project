<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/info/Raspunsuri.php';

$database = new Database();
$db = $database->getConnection();

$info = new Raspunsuri($db);

$result = $info->read();

$num = $result->rowCount();

if($num > 0){
    $responses_arr = array("count" => $num. " raspunsuri");
    $responses_arr["values"] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $responses = array("raspuns" => $row['Response'],"id" => $row['ResponseID']);
        array_push($responses_arr["values"], $responses);
    }
    http_response_code(200);
    echo json_encode($responses_arr);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No responses found")
    );
}
?>