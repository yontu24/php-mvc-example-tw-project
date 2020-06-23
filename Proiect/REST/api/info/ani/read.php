<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/info/Ani.php';

$database = new Database();
$db = $database->getConnection();

$info = new Ani($db);

$result = $info->read();

$num = $result->rowCount();

if($num > 0){
    $years_arr = array("count" => $num. " ani");
    $years_arr["values"] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $year = array("ani" => $row['Year']);
        array_push($years_arr["values"], $year);
    }
    http_response_code(200);
    echo json_encode($years_arr);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No years found")
    );
}
?>