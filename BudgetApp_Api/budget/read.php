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
 
// query products
$stmt = $budget->read();
$num = $stmt->rowCount();

// products array
$budget_arr=array();
$budget_arr["records"]=array();
 
// check if more than 0 record found
if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $budget_item=array(
            "budget_id" => $budget_id,
            "user_id" => $user_id,
            "time_period_id" => $time_period_id,
            "amount" => $amount
        );
 
        array_push($budget_arr["records"], $budget_item);
    }
 
    echo json_encode($budget_arr);
}
 
else{
    echo json_encode($budget_arr);
    // echo json_encode(
    //     array("message" => "No Users found.")
    // );
}
?>