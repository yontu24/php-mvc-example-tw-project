<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../../config/Database.php';
include_once '../../../models/info/Locatii.php';

$database = new Database();
$db = $database->getConnection();

$info = new Locatii($db);

$result = $info->read();

$num = $result->rowCount();

if($num > 0){
    $locations_arr = array("count" => $num. " locatii");
    $locations_arr["values"] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        $locations = array("locatii" => $row['Locationdesc']);
        array_push($locations_arr["values"], $locations);
    }
    http_response_code(200);
    echo json_encode($locations_arr);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No locations found")
    );
}
?>