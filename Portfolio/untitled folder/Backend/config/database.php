<?php

    class Database{
        // Go Daddy
        // private $host = "localhost";
        // private $db_name = "HarshitaPortfolio";
        // private $username = "hs_folio_user";
        // private $password = "hs_folio_user";

        // Go Local
        // private $host = "localhost";
        private $host = "127.0.0.1";
        private $db_name = "HarshitaPortfolio";
        private $username = "hs_folio_user";
        private $password = "hs_folio_user";


        private $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                // mysql:unix_socket=/tmp/mysql.sock
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Connection error : ".$exception->getMessage();
            }
            return $this->conn;
        }
    }

?>