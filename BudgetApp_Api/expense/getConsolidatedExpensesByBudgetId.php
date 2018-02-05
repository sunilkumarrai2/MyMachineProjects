<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/expense.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$expense = new Expense($db);

$expense->budget_id = isset($_GET['budget_id']) ? $_GET['budget_id'] : die();

// query users
$stmt = $expense->getConsolidatedExpensesByBudgetId();
$num = $stmt->rowCount();

$expense_arr=array();
$expense_arr["records"]=array();

// check if more than 0 record found
if($num>0){
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       extract($row);

       $expense_item=array(
           "category_name" => $category_name,
           "category_id" => (int)$category_id,
           "amount" => (int)$amount
       );

       array_push($expense_arr["records"], $expense_item);
   }
   echo json_encode($expense_arr);
}
else{
   echo json_encode($expense_arr);
   // echo json_encode(
   //     array("message" => "No Users found.")
   // );
}


?>