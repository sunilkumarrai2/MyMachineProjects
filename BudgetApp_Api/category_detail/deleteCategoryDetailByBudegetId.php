<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/category_detail.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$category_detail = new Category_Detail($db);
 
// set product id to be deleted
$category_detail->budget_id = isset($_GET['budget_id']) ? $_GET['budget_id'] : die();
$category_detail->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : die();

$status = $category_detail->delete();
// delete the product
if($status){
    echo '{';
        echo '"message": "category_detail was deleted."';
    echo '}';
}
 
// if unable to delete the product
else{
    echo '{';
        echo '"message": "Unable to delete category_detail."';
    echo '}';
}
?>