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

       public function getMaxOrderIndex(){
        $query = "select max(orderIndex) AS maxOrderIndex from ".$this->table_name." order by orderIndex";
        
                    $stmt = $this->conn->prepare($query);
        
                    $stmt->execute();
        
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $index = $row['maxOrderIndex'];
        return $index;
    }

    public function insert(){
        // query to insert record
        // insert into HarshitaPortfolio.beauty_images (url,thumbUrl,height,width,orderIndex) values ('images/Beauty/4.jpg','images/Beauty/Thumbernail/4_120x175.jpg','150px','150px',15);
        $query = "insert into ".$this->table_name." (url,thumbUrl,height,width,orderIndex) values (:url,:thumbUrl,:height,:width,:orderIndex)";
        
                     // prepare query
                    $stmt = $this->conn->prepare($query);
        
                    // sanitize
                    $this->url=htmlspecialchars(strip_tags($this->url));
                    $this->thumbUrl=htmlspecialchars(strip_tags($this->thumbUrl));
                    $this->height=htmlspecialchars(strip_tags($this->height));
                    $this->width=htmlspecialchars(strip_tags($this->width));
                    $this->orderIndex=htmlspecialchars(strip_tags($this->orderIndex));
        
                    // bind values
                    $stmt->bindParam(":url", $this->url);
                    $stmt->bindParam(":thumbUrl", $this->thumbUrl);
                    $stmt->bindParam(":height", $this->height);
                    $stmt->bindParam(":width", $this->width);
                    $stmt->bindParam(":orderIndex", $this->orderIndex);
        
                    // execute query
                    if($stmt->execute()){
                        return true;
                    }else{
                        return false;
                    }
    }

    public function delete(){
        // query to insert record
        // insert into HarshitaPortfolio.beauty_images (url,thumbUrl,height,width,orderIndex) values ('images/Beauty/4.jpg','images/Beauty/Thumbernail/4_120x175.jpg','150px','150px',15);
        $query = "delete from ".$this->table_name." where id = :id";
        
                     // prepare query
                    $stmt = $this->conn->prepare($query);
        
                    // sanitize
                    $this->id=htmlspecialchars(strip_tags($this->id));
        
                    // bind values
                    $stmt->bindParam(":id", $this->id);
        
                    // execute query
                    if($stmt->execute()){
                        return true;
                    }else{
                        return false;
                    }
    }
    }
?>