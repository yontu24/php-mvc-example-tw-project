<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../DB/database.php';
 
$database = new Database();
$db = $database->getConnection(); 

$query = "SELECT DISTINCT Locationdesc FROM `informations` order by Locationdesc ASC;";
$stmt = $db->prepare($query);
$stmt->execute();     

$num = $stmt->rowCount();

if($num>0){
    $contacts_arr=array("locations" => $num. " Locations.");
    $contacts_arr["values"]=array();
    //$contacts_arr = array("values" => array());
    //$contacts_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $contact = array("Locationdesc" => $row['Locationdesc']); 
        //array_push($contacts_arr, $contact);
        array_push($contacts_arr["values"], $contact);
    }
    http_response_code(200);
    echo json_encode($contacts_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No Data.")
    );
}