<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/category_detail.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category_detail = new Category_Detail($db);

$category_detail->budget_id = isset($_GET['budget_id']) ? $_GET['budget_id'] : die();

// query users
$stmt = $category_detail->getCategoriesDetailsByBudgetId();
$num = $stmt->rowCount();

$category_detail_arr=array();
$category_detail_arr["records"]=array();

// check if more than 0 record found
if($num>0){
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       extract($row);

       $category_detail_item=array(
           "budget_id" => (int)$budget_id,
           "category_name" => $category_name,
           "category_id" => (int)$category_id,
           "default_amount" => (int)$default_amount
       );

       array_push($category_detail_arr["records"], $category_detail_item);
   }
   echo json_encode($category_detail_arr);
}
else{
   echo json_encode($category_detail_arr);
   // echo json_encode(
   //     array("message" => "No Users found.")
   // );
}


?>