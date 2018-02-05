<?php 
    class User{
        private $conn;
        private $table_name = "User";

        public $user_id;
        public $user_name;
        public $password;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            
               // select all query
               $query = "SELECT * FROM " . $this->table_name ;
            
               // prepare query statement
               $stmt = $this->conn->prepare($query);
            
               // execute query
               $stmt->execute();
            
               return $stmt;
           }

        public function readUserIdByUsernameAndPassword(){
            // select all query
            // echo $this->user_name." ".$this->password;
            $query = "SELECT * FROM " . $this->table_name." where user_name = :user_name and password = :password";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // bind id of product to be updated
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":password", $this->password);
            // $stmt->bindParam(2, $this->password);
            
            // execute query
            $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set values to object properties
            $this->user_id = $row['user_id'];
            $this->user_name = $row['user_name'];
            $this->password = $row['password'];
            return $this;
        }

    }
?>