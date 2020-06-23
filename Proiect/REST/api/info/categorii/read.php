<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/info/Categorii.php';

$database = new Database();
$db = $database->getConnection();

$info = new Categorii($db);

$result = $info->read();

$num = $result->rowCount();

if($num > 0){
    $categories_arr = array("count" => $num. " categorii");
    $categories_arr["values"] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $categories = array("categorii" => $row['Break_Out_Category'], "id" => $row['BreakOutCategoryID']);
        array_push($categories_arr["values"], $categories);
    }
    http_response_code(200);
    echo json_encode($categories_arr);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No categories found")
    );
}
?>