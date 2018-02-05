<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/specialfx_images.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$special = new Special($db);
 
// query products
$stmt = $special->read();
$num = $stmt->rowCount();

// products array
$special_arr=array();
$special_arr["records"]=array();
 
// check if more than 0 record found
if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $special_item=array(
            "id" => (int)$id,
            "url" => $url,
            "thumbUrl" => $thumbUrl,
            "height" => $height,
            "width" => $width,
            "orderIndex" => (int)$orderIndex
        );
 
        array_push($special_arr["records"], $special_item);
    }
 
    echo json_encode($special_arr);
}
 
else{
    echo json_encode($special_arr);
    // echo json_encode(
    //     array("message" => "No Users found.")
    // );
}
?>