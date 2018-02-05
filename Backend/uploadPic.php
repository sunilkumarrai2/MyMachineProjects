<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once 'config/database.php';
 
// instantiate product object
include_once 'objects/beauty_images.php';
include_once 'objects/creative_images.php';
include_once 'objects/specialfx_images.php';
include_once 'util.php';
 
$util = new Utility();

$database = new Database();
$db = $database->getConnection();

$wholeData = json_decode(file_get_contents("php://input"));

$tableName = $_POST['imageType'];
if($tableName === "beauty"){
    $object = new Beauty($db);
    $main_dir = "../images/Beauty/";
    $thumbernail_dir = "../images/Beauty/Thumbernail/";
}
elseif($tableName === "creative"){
    $object = new Creative($db);
    $main_dir = "../images/creative/";
    $thumbernail_dir = "../images/creative/Thumbernail/";
}    
elseif($tableName === "specilfx"){
    $object = new Special($db);
    $main_dir = "../images/specialFx/";
    $thumbernail_dir = "../images/specialFx/Thumbernail/";
}

$main_image_name = $_FILES["fileToUpload"]["name"];
$thumbernail_image_name = $_FILES["fileToUpload"]["name"];

$lastIndex = strripos($thumbernail_image_name, ".");
$thumbernail_image_name = substr($thumbernail_image_name,0,$lastIndex)."_120x175.jpg";

$source = $_FILES["fileToUpload"]["tmp_name"];
$main_image_destination = $main_dir . basename($main_image_name);
$thumbernail_image_destination = $thumbernail_dir . basename($thumbernail_image_name);

//error_log(print_r($main_image_destination, TRUE));  //../images/specialFx/cust_ty.pe.txt
//error_log(print_r($thumbernail_image_destination, TRUE));  //../images/specialFx/Thumbernail/cust_ty.pe_120x175.jpg

$status = false;


if (copy($source, $main_image_destination) & $util->compress_image($source, $thumbernail_image_destination, 80)) {
    // error_log(print_r("The file ". $main_image_name. " has been uploaded.", TRUE));
    // error_log(print_r("The file ". $main_image_name. " has been uploaded.",true), 3, $_SERVER['DOCUMENT_ROOT']."/php_error.log");
    $object->url = substr($main_image_destination,3);
    $object->thumbUrl = substr($thumbernail_image_destination,3);
    $object->height = "150px";
    $object->width = "150px";
    $object->orderIndex = (int)$object->getMaxOrderIndex() + 1;
    error_log(print_r($object->orderIndex, TRUE));
    $status = $object->insert();
} else {
    error_log(print_r("Sorry, there was an error uploading your file '".$source."' to '".$main_image_destination."' or '".$thumbernail_image_destination."'", TRUE));
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

// array_push($objectTobeReturned["records"], $item);
echo json_encode($objectTobeReturned);

?>