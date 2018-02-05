<?php

    class Database{
        // Go Daddy
        // private $host = "localhost";
        // private $db_name = "BudgetApp";
        // private $username = "sunilkumarrai2d";
        // private $password = "sunhar143";

        // Go Local
        private $host = 'localhost';
        // private $host = "127.0.0.1";
        private $db_name = "BudgetApp";
        private $username = "budget_app_user";
        private $password = "budgetappuser";


        private $conn;

        public function getConnection(){
            $this->conn = null;
            // echo "Connecting to database";
            try{
                // mysql:unix_socket=/tmp/mysql.sock
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
                // echo "Connection established";
            }catch(PDOException $exception){
                echo "Connection error : ".$exception->getMessage();
            }
            return $this->conn;
        }
    }

?>