<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Category($db);
$category->category_name = isset($_GET['categoryName']) ? $_GET['categoryName'] : die();

// query users
$category = $category->getCategoryIdByCategoryName();

$category_arr=array();
$category_arr["records"]=array();

// check if more than 0 record found
if(!is_null($category->category_id)){

       $category_item=array(
           "category_id" => (int)$category->category_id
        //    "category_name" => $category->category_name,
        //    "default_amount" => $category->default_amount,
        //    "is_basic" => $category->is_basic
       );

       array_push($category_arr["records"], $category_item);

       echo json_encode($category_arr);
}

else{
   echo json_encode($category_arr);
   // echo json_encode(
   //     array("message" => "No Users found.")
   // );
}


?>