<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/database.php';
 
// instantiate product object
include_once 'objects/beauty_images.php';
include_once 'objects/creative_images.php';
include_once 'objects/specialfx_images.php';
 
$database = new Database();
$db = $database->getConnection();
 
// get posted data
// $data = json_decode(file_get_contents("php://input"));
$wholeData = json_decode(file_get_contents("php://input"));
$tableName = $wholeData->tableName;
$data = $wholeData->data;

// error_log(print_r($tableName, TRUE));

// $object = new beauty_images($db);
if($tableName === "beauty_images"){$object = new Beauty($db);}
elseif($tableName === "creative_images"){$object = new Creative($db);}    
elseif($tableName === "specialfx_images"){$object = new Special($db);}


error_log(print_r($tableName, TRUE)); 

$status = true;

foreach($data as $item){
    // set product property values
    $object->id = (int)$item->id;
    $object->url = $item->url;
    $object->thumbUrl = $item->thumbUrl;
    $object->height = $item->height;
    $object->width = $item->width;
    $object->orderIndex = (int)$item->orderIndex;
 
    // create the product
    if(!$object->update()){
        $status = false;
    }
}

if($status){
    echo true;
}

// if unable to create the product, tell the user
else{
    echo false;
}
?>