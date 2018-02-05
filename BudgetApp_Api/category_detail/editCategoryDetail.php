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
include_once '../objects/category_detail.php';
 
$database = new Database();
$db = $database->getConnection();
 
$category_detail = new Category_Detail($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
$status = true;

foreach($data as $item){
    // set product property values
    $category_detail->category_id = (int)$item->category_id;
    $category_detail->budget_id = (int)$item->budget_id;
    $category_detail->amount = (int)$item->amount;
 
    // create the product
    if(!$category_detail->update()){
        $status = false;
    }
}

if($status){
    echo '{';
    echo '"message": "category_detail was updated."';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
    echo '"message": "Unable to update category_detail."';
    echo '}';
}
?>