<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../DB/database.php';

$database = new Database();
$db = $database->getConnection(); 

$data = json_decode(file_get_contents("php://input"));

if( !empty($data->locatie) )
{
    $query = "SELECT distinct Year,Locationdesc,Response,Sample_Size,BreakOutCategoryID from informations where Locationdesc = :locatie  ORDER by Year,Locationdesc,BreakOutCategoryID;";
    //$query = "SELECT distinct * FROM informations WHERE Locationdesc = :locatie and Break_Out_Category = :categorie and Response = :raspuns ORDER by BreakoutID , Year;";
    $stmt = $db->prepare($query);

    $insert_array = ["locatie" => $data->locatie];
    $stmt->execute($insert_array);

    $num = $stmt->rowCount();

    if($num>0){
        $contacts_arr=array("data" => $num. " rows");
        $contacts_arr["values"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $contact=array(
                "an" => $row['Year'],
                "locatie" => $row['Locationdesc'],
                "categorie" => $row['Response'],
                "cazuri" => $row['Sample_Size'],
                "IDcategorie" => $row['BreakOutCategoryID']
            ); 
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
}
else{
    http_response_code(400); // bad request
    echo json_encode(array("message" => " Parametru"));
}
?>