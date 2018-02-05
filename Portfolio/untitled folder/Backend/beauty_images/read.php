<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/beauty_images.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$beauty = new Beauty($db);
 
// query products
$stmt = $beauty->read();
$num = $stmt->rowCount();

// products array
$beauty_arr=array();
$beauty_arr["records"]=array();
 
// check if more than 0 record found
if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $beauty_item=array(
            "id" => $id,
            "url" => $url,
            "thumbUrl" => $thumbUrl,
            "height" => $height,
            "width" => $width,
            "orderIndex" => $orderIndex
        );
 
        array_push($beauty_arr["records"], $beauty_item);
    }
 
    echo json_encode($beauty_arr);
}
 
else{
    echo json_encode($beauty_arr);
    // echo json_encode(
    //     array("message" => "No Users found.")
    // );
}
?>