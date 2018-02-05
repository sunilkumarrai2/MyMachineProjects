<?php 
    class Category_Detail{
        private $conn;
        private $table_name = "Category_Detail";

        public $category_detail_id;
        public $category_id;
        public $budget_id;
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

        public function getCategoriesDetailsByBudgetId(){
            $query = "select cd.budget_id,c.category_name,cd.category_id,cd.amount as default_amount from Category_Detail cd join Category c on cd.category_id=c.category_id where cd.budget_id = :budget_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":budget_id", $this->budget_id);

            $stmt->execute();
            
            return $stmt;
        }

        public function create(){
            // query to insert record
            $query = "INSERT INTO ".$this->table_name." SET category_id=:category_id, budget_id=:budget_id, amount=:amount";
            
            // prepare query
            $stmt = $this->conn->prepare($query);
            
            // sanitize
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->budget_id=htmlspecialchars(strip_tags($this->budget_id));
            $this->amount=htmlspecialchars(strip_tags($this->amount));
            
            // bind values
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":budget_id", $this->budget_id);
            $stmt->bindParam(":amount", $this->amount);
            
            // execute query
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        // delete the product
        public function delete(){

            // delete query
            $query = "delete from Category_Detail where category_id = :category_id and budget_id = :budget_id";
            
            error_log(print_r($query, TRUE));

            // prepare query
            $stmt = $this->conn->prepare($query);
    
            // sanitize
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->budget_id=htmlspecialchars(strip_tags($this->budget_id));
    
            // bind id of record to delete
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":budget_id", $this->budget_id);
    
            // execute query
            if($stmt->execute()){
                return true;
            }
    
            return false;
        
        }

        public function update(){
            if($this->getCategoriesDetailsByBudgetIdAndCategoryId() > 0){
                
                            // query to insert record
                            $query = "update Category_Detail set amount = :amount where budget_id = :budget_id and category_id = :category_id";
                
                             // prepare query
                            $stmt = $this->conn->prepare($query);
                
                            // sanitize
                            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
                            $this->budget_id=htmlspecialchars(strip_tags($this->budget_id));
                            $this->amount=htmlspecialchars(strip_tags($this->amount));
                
                            // bind values
                            $stmt->bindParam(":category_id", $this->category_id);
                            $stmt->bindParam(":budget_id", $this->budget_id);
                            $stmt->bindParam(":amount", $this->amount);
                
                            // execute query
                            if($stmt->execute()){
                                return true;
                            }else{
                                return false;
                            }
            }else{
                   return $this->create();     
            }

        }

        public function getCategoriesDetailsByBudgetIdAndCategoryId(){
            $query = "select * from Category_Detail where budget_id = :budget_id and category_id = :category_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":budget_id", $this->budget_id);
            $stmt->bindParam(":category_id", $this->category_id);

            $stmt->execute();
            
            return $stmt->rowCount();
        }


}
?>