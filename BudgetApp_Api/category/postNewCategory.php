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
include_once '../objects/category.php';
 
$database = new Database();
$db = $database->getConnection();
 
$category = new Category($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$category->category_name = $data->category_name;
$category->default_amount = (int)$data->default_amount;
$category->is_basic = (int)$data->is_basic;
 
$category_arr=array();
$category_arr["records"]=array();
// create the product
if($category->create()){
    $newlyInsertedCategory = $category->getCategoryIdByCategoryName();
    error_log(print_r("vvvvv", TRUE)); 
    error_log(print_r($newlyInsertedCategory->category_id, TRUE)); 
    $category_item=array(
        "category_id" => (int)$newlyInsertedCategory->category_id
     //    "category_name" => $category->category_name,
     //    "default_amount" => $category->default_amount,
     //    "is_basic" => $category->is_basic
    );

    array_push($category_arr["records"], $category_item);

    echo json_encode($category_arr);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode($category_arr);
}
?>