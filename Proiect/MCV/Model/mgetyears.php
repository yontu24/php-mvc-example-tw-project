<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../DB/database.php';

$database = new Database();
$db = $database->getConnection(); 

$data = json_decode(file_get_contents("php://input"));

if( !empty($data->locatie) )
{
    $query = "SELECT DISTINCT Year from informations where Locationdesc = :locatie  ORDER by Year ASC;";
    $stmt = $db->prepare($query);

    $insert_array = ["locatie" => $data->locatie];
    $stmt->execute($insert_array);

    $num = $stmt->rowCount();

    if($num>0){
        $contacts_arr=array("Number" => $num. " years");
        $contacts_arr["years"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contact=array("an" => $row['Year']); 
            array_push($contacts_arr["years"], $contact);
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
}
else{
    http_response_code(400); // bad request
    echo json_encode(array("message" => " Invalid parameter"));
}
?>