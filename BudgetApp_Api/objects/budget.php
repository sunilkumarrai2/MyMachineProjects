<?php 
    class Budget{
        private $conn;
        private $table_name = "Budget";

        public $budget_id;
        public $user_id;
        public $time_period_id;
        public $amount;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "select * from ".$this->table_name;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function getBudgetByTimeperiodAndUserId(){
            // select all query
            // echo $this->user_name." ".$this->password;
            $query = "SELECT * FROM " . $this->table_name." where user_id = :user_id and time_period_id = :time_period_id";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // bind id of product to be updated
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":time_period_id", $this->time_period_id);
            // $stmt->bindParam(2, $this->password);
            
            // execute query
            $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->budget_id = $row['budget_id'];
            $this->user_id = $row['user_id'];
            $this->time_period_id = $row['time_period_id'];
            $this->amount = $row['amount'];

            return $this;
        }

        public function getMostRecentBudgetIdByUserId(){
            $query = "select b.*,tp.budget_month from budget b join Time_Period tp on b.time_period_id = tp.time_period_id where b.user_id = :user_id order by tp.budget_month desc";
            
            // echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":user_id", $this->user_id);
            
            $stmt->execute();
            
            return $stmt;
        }

        // create product
        function create(){
    
            // query to insert record
            $query = "INSERT INTO
                   " . $this->table_name . "
               SET
                user_id=:user_id, time_period_id=:time_period_id, amount=:amount";
    
            // prepare query
            $stmt = $this->conn->prepare($query);
    
            // sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->time_period_id=htmlspecialchars(strip_tags($this->time_period_id));
            $this->amount=htmlspecialchars(strip_tags($this->amount));
    
            // bind values
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":time_period_id", $this->time_period_id);
            $stmt->bindParam(":amount", $this->amount);
    
            // execute query
            if($stmt->execute()){
                return true;
            }else{
            return false;
            }
        }
    }
?>