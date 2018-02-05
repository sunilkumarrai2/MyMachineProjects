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

$url = isset($_GET['url']) ? $_GET['url'] : die();

$status = false;

if(copy("../".$url, "../images/front_pic.jpeg")){
    $status = true;
}else{
    error_log(print_r("Unable to replace home_pic", TRUE));
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