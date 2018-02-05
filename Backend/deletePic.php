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

$id = isset($_GET['id']) ? $_GET['id'] : die();
$tableName = isset($_GET['imageType']) ? $_GET['imageType'] : die();

$thumbUrl = isset($_GET['thumbUrl']) ? $_GET['thumbUrl'] : die();
$thumbUrl = "../".$thumbUrl;
$url = isset($_GET['url']) ? $_GET['url'] : die();
$url = "../".$url;
if($tableName === "beauty"){
    $object = new Beauty($db);
}
elseif($tableName === "creative"){
    $object = new Creative($db);
}    
elseif($tableName === "specilfx"){
    $object = new Special($db);
}

$object->id = (int)$id;

$status = false;

if(unlink($thumbUrl) & unlink($url)){
    $status = $object->delete();
}else{
    error_log(print_r("Unable to delete ".$thumbUrl." and ".$url, TRUE));
}

if($status){
    $objectTobeReturned=array(
        "result" => true
    );
}
else{
    $objectTobeReturned=array(
        "result" => false
    );
}

echo json_encode($objectTobeReturned);

?>