<?php 
    class Expense{
        private $conn;
        private $table_name = "Expenses";

        public $expense_id;
        public $expense_name;
        public $category_id;
        public $amount;
        public $budget_id;
        public $expense_date;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "select * from ".$this->table_name;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

         // create product
         public function create(){
            
                    // query to insert record
                    $query = "INSERT INTO  Expenses SET category_id=:category_id, amount=:amount, expense_name=:expense_name, budget_id=:budget_id, expense_date=:expense_date";
            
                    // prepare query
                    $stmt = $this->conn->prepare($query);
            
                    // sanitize
                    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
                    $this->amount=htmlspecialchars(strip_tags($this->amount));
                    $this->expense_name=htmlspecialchars(strip_tags($this->expense_name));
                    $this->budget_id=htmlspecialchars(strip_tags($this->budget_id));
                    $this->expense_date=htmlspecialchars(strip_tags($this->expense_date));
            
                    // bind values
                    $stmt->bindParam(":category_id", $this->category_id);
                    $stmt->bindParam(":amount", $this->amount);
                    $stmt->bindParam(":expense_name", $this->expense_name);
                    $stmt->bindParam(":budget_id", $this->budget_id);
                    $stmt->bindParam(":expense_date", $this->expense_date);
            
                    // execute query
                    if($stmt->execute()){
                        return true;
                    }else{
                    return false;
                    }
                }

        public function getAllExpensesByBudgetIdWithCategoryIdReplacedByItsName(){
            $query = "select e.expense_id ,e.expense_name,e.category_id,c.category_name,e.amount,e.budget_id,DATE_FORMAT(e.expense_date, '%M %d, %Y') as expense_date from Expenses e left join Category c on e.category_id = c.category_id where budget_id = :budget_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":budget_id", $this->budget_id);

            $stmt->execute();
            
            return $stmt;
        }

        public function getConsolidatedExpensesByBudgetId(){
            $query= "select temp.category_name, temp.category_id, sum(temp.amount) as amount from(select e.expense_id ,e.expense_name,e.category_id,c.category_name,e.amount,e.budget_id,DATE_FORMAT(e.expense_date, '%M %d, %Y') as expense_date from Expenses e left join Category c on e.category_id = c.category_id where budget_id = :budget_id) temp group by temp.category_id";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":budget_id", $this->budget_id);

            $stmt->execute();
            
            return $stmt;
        }

        public function getBalanceForEachCategoryInGivenBudgetId(){
            $query= "select a.category_name, CASE WHEN b.amount IS NULL THEN a.default_amount ELSE (a.default_amount - b.amount) END AS balance from (select cd.budget_id,c.category_name,cd.category_id,cd.amount as default_amount from Category_Detail cd join Category c on cd.category_id=c.category_id where cd.budget_id = :budget_id1) a left join (select temp.category_name, temp.category_id, sum(temp.amount) as amount from(select e.expense_id ,e.expense_name,e.category_id,c.category_name,CASE WHEN e.amount IS NULL THEN 0 ELSE e.amount END AS amount,e.budget_id,DATE_FORMAT(e.expense_date, '%M %d, %Y') as expense_date from Expenses e left join Category c on e.category_id = c.category_id where budget_id = :budget_id2) temp group by temp.category_id) b on a.category_id=b.category_id";

            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":budget_id1", $this->budget_id);
            $stmt->bindParam(":budget_id2", $this->budget_id);

            $stmt->execute();
            
            return $stmt;
        }
    }
?>
