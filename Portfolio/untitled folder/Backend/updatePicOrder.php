<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once 'objects/beauty_images.php';
include_once 'objects/creative_images.php';
include_once 'objects/specialfx_images.php';
 
$database = new Database();
$db = $database->getConnection();
 
$category_detail = new Category_Detail($db);
 
// get posted data
$wholeData = json_decode(file_get_contents("php://input"));
$tableName = $wholeData.tableName;
if($tableName === "beauty_images"){$object = new beauty_images($db);}
elseif($tableName === "creative_images"){$object = new creative_images($db);}    
elseif($tableName === "specialfx_images"){$object = new specialfx_images($db);}

$data = $wholeData.data;

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
    echo '{';
    echo '"status":"Success"';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
    echo '"status":"Failed"';
    echo '}';
}
?>