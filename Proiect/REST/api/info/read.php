<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Info.php';

$database = new Database();
$db = $database->getConnection();

$info = new Info($db);

if(isset($_GET['an'])){
    $info->an = $_GET['an'];
} else{
    $info->an = null;
}
if(isset($_GET['locatie'])){
    $info->locatie = $_GET['locatie'];
} else{
    $info->locatie = null;
}
if(isset($_GET['raspuns'])){
    $info->id_raspuns = $_GET['raspuns'];
} else{
    $info->id_raspuns = null;
}
if(isset($_GET['categorie'])){
    $info->id_categorie = $_GET['categorie'];
} else{
    $info->id_categorie = null;
}


$result = $info->read();

$num = $result->rowCount();

if($num > 0){
    $info_arr = array("count" => $num. " informatii");
    $info_arr["values"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        if(isset($_GET['an']) && isset($_GET['locatie']) && isset($_GET['raspuns']) && isset($_GET['categorie']))
        {
            $info = array("break_out" => $row['Break_Out'], "cazuri" => $row['Sample_Size']);
        } else if(isset($_GET['an']))
        {
            $info = array("ani" => $row['Year']);
        } else if(isset($_GET['locatie']))
        {
            $info = array("locatii" => $row['Locationdesc']);
        } else if(isset($_GET['raspuns']))
        {
            $info = array("raspuns" => $row['Response'],
                        "id" => $row['ResponseID']);
        } else if(isset($_GET['categorie']))
        {
            $info = array("categorii" => $row['Break_Out_Category'],
                        "id" => $row['BreakOutCategoryID']);
        }
        array_push($info_arr["values"], $info);
    }
    http_response_code(200);
    echo json_encode($info_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No Data.")
    );
}
?>