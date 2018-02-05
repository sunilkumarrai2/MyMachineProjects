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
include_once '../objects/expense.php';
 
$database = new Database();
$db = $database->getConnection();
 
$expense = new Expense($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$expense->expense_name = $data->expense_name;
$expense->category_id = (int)$data->category_id;
$expense->amount = (int)$data->amount;
$expense->budget_id = (int)$data->budget_id;
$expense->expense_date = $data->expense_date;
 
// create the product
if($expense->create()){
    echo '{';
        echo '"message": "expense was created."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create expense."';
    echo '}';
}
?>