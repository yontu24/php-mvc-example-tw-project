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

if( !empty($data->locatie) && !empty($data->an))
{
    $query = "SELECT distinct Sample_Size,BreakoutID from informations where `Year` = :an and `Locationdesc` = :locatie and `Response` = :raspuns and `Break_Out_Category` = :categorie ORDER BY BreakoutID ASC;";
    //$query = "SELECT distinct * FROM informations WHERE Locationdesc = :locatie and Break_Out_Category = :categorie and Response = :raspuns ORDER by BreakoutID , Year;";
    $stmt = $db->prepare($query);

    $insert_array = [
        "an" => $data->an,
        "locatie" => $data->locatie , 
        "raspuns" => 'Obese (BMI 30.0 - 99.8)',
        "categorie" => 'Age Group'    
    ];
    $stmt->execute($insert_array);

    $num = $stmt->rowCount();

    if($num>0){
        $contacts_arr=array("data" => $num. " rows");
        $contacts_arr["values"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contact=array(
                "cazuri" => $row['Sample_Size'],
                "categorie" => $row['BreakoutID']
            ); 
            array_push($contacts_arr["values"], $contact);
        }
        http_response_code(200);
        echo json_encode($contacts_arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => " No Data")
        );
    }
}
else{
    http_response_code(400); // bad request
    echo json_encode(array("message" => " Invalid parameter"));
}
?>