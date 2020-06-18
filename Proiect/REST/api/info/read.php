<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Info.php';

$database = new Database();
$db = $database->getConnection();

$info = new Info($db);

if(isset($_GET['an'])){
    $info->an = explode(',',$_GET['an']);
} else{
    $info->an = null;
}
if(isset($_GET['locatie'])){
    $aux = str_replace('_', ' ',$_GET['locatie']);
    $info->locatie = explode(',',$aux);
} else{
    $info->locatie = null;
}
if(isset($_GET['raspuns'])){
    $info->id_raspuns = explode(',',$_GET['raspuns']);
} else{
    $info->id_raspuns = null;
}
if(isset($_GET['categorie'])){
    $info->id_categorie = $_GET['categorie'];
} else{
    $info->id_categorie = null;
}
// foreach($info->an as $ani)
//     echo $ani." bun venit la ani";
// foreach($info->locatie as $locatii)
//     echo $locatii. " bun venit la locatii";
// foreach($info->id_raspuns as $raspunsuri)
//     echo $raspunsuri. " bun venit la locatii";


if($info->an != null && $info->locatie != null && $info->id_raspuns != null && $info->id_categorie != null){
    $info_arr = array("count" =>" informatii");
    $info_arr["values"] = array();
    $prima_data = true;

    foreach($info->an as $ani){
        //echo $ani." bun venit la ani     ";
        foreach($info->locatie as $locatii){
            //echo $locatii. " bun venit la locatii       ";
            foreach($info->id_raspuns as $raspunsuri){
                //echo $raspunsuri. " bun venit la raspunsuri         ";
                $result = $info->read($ani,$locatii,$raspunsuri,$info->id_categorie);

                $num = $result->rowCount();

                if($num > 0){
                    $contor = 0;
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                        if($prima_data){
                            $info_aux = array("break_out" => $row['Break_Out'], "cazuri" => $row['Sample_Size']);
                            array_push($info_arr["values"], $info_aux);
                        }else{
                            //echo $info_arr['values'][$contor]['cazuri'] . " prima valoare ". $row['Sample_Size'] . " spatiu             ";
                            $info_arr['values'][$contor]['cazuri'] = $info_arr['values'][$contor]['cazuri'] + $row['Sample_Size'];
                            $contor++;
                        }
                    }
                    $prima_data = false;
                }
            }
        }
    }
    http_response_code(200);
    echo json_encode($info_arr);
}else if($info->an != null){
    $result = $info->read($info->an,null,null,null);
    $num = $result->rowCount();
    if($num > 0){
        $info_arr = array("count" => $num. " informatii");
        $info_arr["values"] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $info = array("ani" => $row['Year']);
            array_push($info_arr["values"], $info);
        }
        http_response_code(200);
        echo json_encode($info_arr);
    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Data.")
        );
    }
} else if($info->locatie != null){
    $result = $info->read(null,$info->locatie,null,null);
    $num = $result->rowCount();
    if($num > 0){
        $info_arr = array("count" => $num. " informatii");
        $info_arr["values"] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $info = array("locatii" => $row['Locationdesc']);
            array_push($info_arr["values"], $info);
        }
        http_response_code(200);
        echo json_encode($info_arr);
    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Data.")
        );
    }
} else if($info->id_raspuns != null){
    $result = $info->read(null,null,$info->id_raspuns,null);
    $num = $result->rowCount();
    if($num > 0){
        $info_arr = array("count" => $num. " informatii");
        $info_arr["values"] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $info = array("raspuns" => $row['Response'],"id" => $row['ResponseID']);
            array_push($info_arr["values"], $info);
        }
        http_response_code(200);
        echo json_encode($info_arr);
    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Data.")
        );
    }
} else if($info->id_categorie != null){
    $result = $info->read(null,null,null,$info->id_categorie);
    $num = $result->rowCount();
    if($num > 0){
        $info_arr = array("count" => $num. " informatii");
        $info_arr["values"] = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $info = array("categorii" => $row['Break_Out_Category'], "id" => $row['BreakOutCategoryID']);
            array_push($info_arr["values"], $info);
        }
        http_response_code(200);
        echo json_encode($info_arr);
    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Data.")
        );
    }
}

// $result = $info->read();

// $num = $result->rowCount();

// if($num > 0){
//     $info_arr = array("count" => $num. " informatii");
//     $info_arr["values"] = array();

//     while ($row = $result->fetch(PDO::FETCH_ASSOC)){
//         if(isset($_GET['an']) && isset($_GET['locatie']) && isset($_GET['raspuns']) && isset($_GET['categorie']))
//         {
//             $info = array("break_out" => $row['Break_Out'], "cazuri" => $row['Sample_Size']);
//         } else if(isset($_GET['an']))
//         {
//             $info = array("ani" => $row['Year']);
//         } else if(isset($_GET['locatie']))
//         {
//             $info = array("locatii" => $row['Locationdesc']);
//         } else if(isset($_GET['raspuns']))
//         {
//             $info = array("raspuns" => $row['Response'],
//                         "id" => $row['ResponseID']);
//         } else if(isset($_GET['categorie']))
//         {
//             $info = array("categorii" => $row['Break_Out_Category'],
//                         "id" => $row['BreakOutCategoryID']);
//         }
//         array_push($info_arr["values"], $info);
//     }
//     foreach($info_arr["values"] as $ceva){
//         echo $ceva["cazuri"];
//     }
//     http_response_code(200);
//     echo json_encode($info_arr);
// }
// else{
//     http_response_code(404);
//     echo json_encode(
//         array("message" => "No Data.")
//     );
// }
?>