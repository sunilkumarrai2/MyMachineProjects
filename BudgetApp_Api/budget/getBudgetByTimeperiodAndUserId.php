<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/budget.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$budget = new Budget($db);
$budget->time_period_id = isset($_GET['periodId']) ? $_GET['periodId'] : die();
$budget->user_id = isset($_GET['userId']) ? $_GET['userId'] : die();


// query users
$budget = $budget->getBudgetByTimeperiodAndUserId();

if(!is_null($budget->budget_id)){
    // create array
    $budget_item = array(
        "budget_id" =>  $budget->budget_id,
        "user_id" => $budget->user_id,
        "time_period_id" => $budget->time_period_id,
        "amount" => $budget->amount
    );
    $budget_arr=array();
    $budget_arr["records"]=array();
    
    array_push($budget_arr["records"], $budget_item);
    
}else{
    $budget_arr=array();
    $budget_arr["records"]=array();
}


// make it json format
echo json_encode($budget_arr);

?>