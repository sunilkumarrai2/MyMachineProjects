<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new User($db);
$user->user_name = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

// query users
$user = $user->readUserIdByUsernameAndPassword();

if(!is_null($user->user_id)){
    // create array
    $user_item = array(
        "user_id" =>  $user->user_id,
        "user_name" => $user->user_name,
        "password" => $user->password
    );
    $user_arr=array();
    $user_arr["records"]=array();
    
    array_push($user_arr["records"], $user_item);
    
}else{
    $user_arr=array();
    $user_arr["records"]=array();
}


// make it json format
echo json_encode($user_arr);


?>