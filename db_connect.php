<?php
 
 echo "My first PHP script!<br>";
 // GO DADDY --- php = PHP Version 5.6.31
//  $dbhost = 'localhost:3306';
//  $dbuser = 'sunilkumarrai2d';
//  $dbpass = 'sunhar143';

 //LOCAL  ----- php = 5.5.38
 $dbhost = 'localhost:/tmp/mysql.sock';
 $dbuser = 'budget_app_user';
 $dbpass = 'budgetappuser';
 $db_name = "BudgetApp";

//  $conn = mysql_connect($dbhost, $dbuser, $dbpass);
//  if(! $conn ) {
// //                die('Could not connect: ' . mysql_error());
//                   echo('Could not connect: ' . mysql_error());
//               }
// else{
//         echo '<h2>Connected successfully</h2>';
//         mysql_close($conn);
//     }

$mysqli = new mysqli('127.0.0.1',  $dbuser,  $dbpass, $db_name);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo '<p>Connection OK '. $mysqli->host_info.'</p>';
$query = "select time_period_id,DATE_FORMAT(budget_month, '%Y, %M') as budget_month from Time_Period";

$stmt = $mysqli->prepare($query);

mysqli_query($mysqli,$query);

$stmt->execute();

?>