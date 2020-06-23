<?php
    class Raspunsuri{
        private $conn;

        public $raspuns;
        public $id_raspuns;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT DISTINCT Response, ResponseID FROM informations order by ResponseID ASC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }
    }
?>