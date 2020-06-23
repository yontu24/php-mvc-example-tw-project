<?php
    class Ani{
        private $conn;

        public $an;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT DISTINCT Year FROM informations order by Year ASC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }
    }
?>