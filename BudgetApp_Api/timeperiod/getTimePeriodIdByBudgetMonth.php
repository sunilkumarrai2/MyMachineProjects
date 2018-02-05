<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/timeperiod.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$timeperiod = new Time_Period($db);
 
// set ID property of product to be edited
$timeperiod->budget_month = isset($_GET['budget_month']) ? $_GET['budget_month'] : die();
 
$timeperiod->readTimeperiodByBudgetMonth();

if(!is_null($timeperiod->time_period_id)){
    // create array
    $timeperiod_item = array(
        "time_period_id" =>  $timeperiod->time_period_id,
        "budget_month" => $timeperiod->budget_month
    );
 
    $timeperiod_arr=array();
    $timeperiod_arr["records"]=array();
    array_push($timeperiod_arr["records"], $timeperiod_item);
}
else{
    $timeperiod_arr=array();
    $timeperiod_arr["records"]=array();
}    

// make it json format
echo json_encode($timeperiod_arr);
?>