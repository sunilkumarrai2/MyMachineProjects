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
 $conn = mysql_connect($dbhost, $dbuser, $dbpass);
 if(! $conn ) {
//                die('Could not connect: ' . mysql_error());
                  echo('Could not connect: ' . mysql_error());
              }
          else{
                  echo '<h2>Connected successfully</h2>';
                  mysql_close($conn);
              }
?>