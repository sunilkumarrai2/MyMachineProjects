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
include_once '../objects/budget.php';
 
$database = new Database();
$db = $database->getConnection();
 
$budget = new Budget($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$budget->user_id = (int)$data->user_id;
$budget->time_period_id = $data->time_period_id;
$budget->amount = (int)$data->amount;
 
// create the product
if($budget->create()){
    echo '{';
        echo '"message": "budget was created."';
    echo '}';
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create budget."';
    echo '}';
}
?>