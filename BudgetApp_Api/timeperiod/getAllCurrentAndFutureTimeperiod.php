<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/timeperiod.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$timeperiod = new Time_Period($db);
 
// query products
$stmt = $timeperiod->readCurrentAndFutureTimeperiod();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $timeperiod_arr=array();
    $timeperiod_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $timeperiod_item=array(
            "time_period_id" => $time_period_id,
            "budget_month" => $budget_month
        );
 
        array_push($timeperiod_arr["records"], $timeperiod_item);
    }
 
    echo json_encode($timeperiod_arr);
}
 
else{
    echo json_encode($timeperiod_arr);
    // echo json_encode(
    //     array("message" => "No Users found.")
    // );
}
?>