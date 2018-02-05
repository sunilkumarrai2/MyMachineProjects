<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/creative_images.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$creative = new Creative($db);
 
// query products
$stmt = $creative->read();
$num = $stmt->rowCount();

// products array
$creative_arr=array();
$creative_arr["records"]=array();
 
// check if more than 0 record found
if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $creative_item=array(
            "id" => (int)$id,
            "url" => $url,
            "thumbUrl" => $thumbUrl,
            "height" => $height,
            "width" => $width,
            "orderIndex" => (int)$orderIndex
        );
 
        array_push($creative_arr["records"], $creative_item);
    }
 
    echo json_encode($creative_arr);
}
 
else{
    echo json_encode($creative_arr);
    // echo json_encode(
    //     array("message" => "No Users found.")
    // );
}
?>