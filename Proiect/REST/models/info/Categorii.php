<?php
    class Categorii{
        private $conn;

        public $categorie;
        public $id_categorie;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT DISTINCT Break_Out_Category, BreakOutCategoryID FROM informations order by BreakOutCategoryID ASC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }
    }
?>