<?php 
    class Special{
        private $conn;
        private $table_name = "specialfx_images";

        public $id;
        public $url;
        public $thumbUrl;
        public $height;
        public $width;
        public $orderIndex;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "select * from ".$this->table_name." order by orderIndex";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        public function update(){
            // query to insert record
            $query = "update specialfx_images set orderIndex = :orderIndex where id = :id";
            
                         // prepare query
                        $stmt = $this->conn->prepare($query);
            
                        // sanitize
                        $this->id=htmlspecialchars(strip_tags($this->id));
                        $this->orderIndex=htmlspecialchars(strip_tags($this->orderIndex));
            
                        // bind values
                        $stmt->bindParam(":id", $this->id);
                        $stmt->bindParam(":orderIndex", $this->orderIndex);
            
                        // execute query
                        if($stmt->execute()){
                            return true;
                        }else{
                            return false;
                        }
       }
    }
?>