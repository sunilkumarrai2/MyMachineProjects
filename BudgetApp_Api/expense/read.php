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
 
// query products
$stmt = $expense->read();
$num = $stmt->rowCount();
 
// products array
$expense_arr=array();
$expense_arr["records"]=array();

// check if more than 0 record found
if($num>0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $expense_item=array(
            "expense_id" => $expense_id,
            "expense_name" => $expense_name,
            "category_id" => $category_id,
            "amount" => $amount,
            "budget_id" => $budget_id,
            "expense_date" => $expense_date
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