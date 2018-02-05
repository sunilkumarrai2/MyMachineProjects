<?php 
    class Time_Period{
        private $conn;
        private $table_name = "Time_Period";

        public $time_period_id;
        public $budget_month;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "select time_period_id,DATE_FORMAT(budget_month, '%Y, %M') as budget_month from ".$this->table_name;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;

        }

        public function readCurrentAndFutureTimeperiod(){
            // $query = "select time_period_id,DATE_FORMAT(budget_month, '%Y, %M') as budget_month from ".$this->table_name." where budget_month >= CURDATE()";
            $query = "select time_period_id,DATE_FORMAT(budget_month, '%Y, %M') as budget_month from ".$this->table_name." where  DATE_FORMAT(budget_month, '%Y %m') >= DATE_FORMAT(CURDATE(), '%Y %m')";
            
                        $stmt = $this->conn->prepare($query);
            
                        $stmt->execute();
            
                        return $stmt;
        }

        public function readTimeperiodByBudgetMonth(){
            // query to read single record
            $query = "SELECT time_period_id,DATE_FORMAT(budget_month, '%Y, %M') as budget_month FROM " . $this->table_name . " where budget_month = ?";
            
            // prepare query statement
            $stmt = $this->conn->prepare( $query );

            // bind id of product to be updated
            $stmt->bindParam(1, $this->budget_month);

            // execute query
            $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->time_period_id = $row['time_period_id'];
            $this->budget_month = $row['budget_month'];
        }


    }
?>