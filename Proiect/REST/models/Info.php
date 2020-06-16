<?php
    class Info{
        private $conn;
        private $table = 'informations';

        public $an;
        public $locatie;
        public $raspuns;
        public $id_raspuns;
        public $break_out;
        public $id_break_out;
        public $categorie;
        public $id_categorie;
        public $cazuri;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "";
            if( isset($this->an)  && isset($this->locatie)  && isset($this->id_raspuns) && isset($this->id_categorie) )
            {
                $query = "SELECT DISTINCT Break_Out, Sample_Size FROM informations where Year = '" . $this->an . "' and Locationdesc = '" . $this->locatie . "' and ResponseID = '" . $this->id_raspuns . "' and BreakOutCategoryID = '" . $this->id_categorie . "'  order by Break_Out ASC";
            }
            else if( $this->an == 'true')
            {
                $query = "SELECT DISTINCT Year FROM informations order by Year ASC";
            } 
            else if( $this->locatie == 'true')
            {
                $query = "SELECT DISTINCT Locationdesc FROM informations order by Locationdesc ASC";
            } 
            else if( $this->id_raspuns == 'true')
            {
                $query = "SELECT DISTINCT Response, ResponseID FROM informations order by ResponseID ASC";
            } 
            else if( $this->id_categorie == 'true'){
                $query = "SELECT DISTINCT Break_Out_Category, BreakOutCategoryID FROM informations order by BreakOutCategoryID ASC";
            }
            //echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }

        public function read_2(){
            $query = "SELECT DISTINCT Locationdesc FROM informations order by Locationdesc ASC";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();   
            
            return $stmt;
        }
    }
?>