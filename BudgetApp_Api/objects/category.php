<?php 
    class Category{
        public $category_id;
        public $category_name;
        public $default_amount;
        public $is_basic;

        public $conn;
        public $table_name = "Category";

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "select * from ".$this->table_name;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function readBasicCategory(){
            $query = "select * from ".$this->table_name." where is_basic = 1";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->execute();
            
            return $stmt;
        }

        public function getCategoryByBudgetId($budgetId){
            $query = "select c.*, cd.amount, cd.budget_id from Category_Detail cd inner join Category c on cd.category_id = c.category_id and cd.budget_id = ?";;
            
            $stmt = $this->conn->prepare($query);

            // bind id of product to be updated
            $stmt->bindParam(1, $budgetId);
            
            $stmt->execute();
            
            return $stmt;
        }

        public function getCategoryIdByCategoryName(){
            $query = "SELECT * FROM " . $this->table_name." where category_name = :category_name";
            
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            
            // bind id of product to be updated
            $stmt->bindParam(":category_name", $this->category_name);
                        
            // execute query
            $stmt->execute();
            
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // set values to object properties
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            $this->default_amount = $row['default_amount'];
            $this->is_basic = $row['is_basic'];
            
            return $this;
        }

        public function create(){
            // query to insert record
            $query = "INSERT INTO Category SET category_name=:category_name, default_amount=:default_amount, is_basic=:is_basic";

            // prepare query
            $stmt = $this->conn->prepare($query);

             // sanitize
            $this->category_name=htmlspecialchars(strip_tags($this->category_name));
            $this->default_amount=htmlspecialchars(strip_tags($this->default_amount));
            $this->is_basic=htmlspecialchars(strip_tags($this->is_basic)); 

            // bind values
            $stmt->bindParam(":category_name", $this->category_name);
            $stmt->bindParam(":default_amount", $this->default_amount);
            $stmt->bindParam(":is_basic", $this->is_basic);

            // execute query
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

    }
?>