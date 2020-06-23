<?php
    class Info{
        private $conn;

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

        public function read($an,$locatie,$id_raspuns,$id_categorie){
            $query = "";
            if( isset($an)  && isset($locatie)  && isset($id_raspuns) && isset($id_categorie) )
            {
                $query = "SELECT DISTINCT Break_Out, Sample_Size FROM informations where Year = '" . $an . "' and Locationdesc = '" . $locatie . "' and ResponseID = '" . $id_raspuns . "' and BreakOutCategoryID = '" . $id_categorie . "'  order by Break_Out ASC";
            }
            //echo $query;

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO informations (Year, Locationabbr, Locationdesc, Class, Topic, Question, Response, Break_Out, Break_Out_Category , Sample_Size, BreakoutID, BreakOutCategoryID, ResponseID) VALUES 
            (:year, :id_locatie, :locatie,'Overweight and Obesity (BMI)', 'BMI Categories', 'Weight classification by Body Mass Index (BMI) (va...', :raspuns, :Break_Out, :categorie, :nr_cazuri, :id_Break_Out, :id_categorie, :id_raspuns);";
            
            $stmt = $this->conn->prepare($query);

            if($this->id_categorie == "CAT1"){
                $this->categorie = "Overall";
            }else if($this->id_categorie == "CAT2"){
                $this->categorie = "Gender";
            }else if($this->id_categorie == "CAT3"){
                $this->categorie = "Age Group";
            }else if($this->id_categorie == "CAT4"){
                $this->categorie = "Race/Ethnicity";
            }else if($this->id_categorie == "CAT5"){
                $this->categorie = "Education Attained";
            }else if($this->id_categorie == "CAT6"){
                $this->categorie = "Household Income";
            }
            if($this->id_raspuns == "RESP039")
                $this->raspuns = "Obese (BMI 30.0 - 99.8)";
            else if($this->id_raspuns == "RESP040")
                $this->raspuns = "Overweight (BMI 25.0-29.9)";
            else if($this->id_raspuns == "RESP041")
                $this->raspuns = "Normal Weight (BMI 18.5-24.9)";
            else if($this->id_raspuns == "RESP042")
                $this->raspuns = "Underweight (BMI 12.0-18.4)";

            $initiale_locatie = strtoupper(substr($this->locatie, 0, 2));

            $this->an = htmlspecialchars(strip_tags($this->an));
            $this->locatie = htmlspecialchars(strip_tags($this->locatie));
            $this->break_out = htmlspecialchars(strip_tags($this->break_out));
            $this->nr_cazuri = htmlspecialchars(strip_tags($this->nr_cazuri));
            $this->id_break_out = htmlspecialchars(strip_tags($this->id_break_out));
            $this->id_categorie = htmlspecialchars(strip_tags($this->id_categorie));
            $this->id_raspuns = htmlspecialchars(strip_tags($this->id_raspuns));

            $insert_array = ["year" => $this->an,
                            "id_locatie" => $initiale_locatie,
                            "locatie" => $this->locatie,
                            "raspuns" => $this->raspuns,
                            "Break_Out" => $this->break_out,
                            "categorie" => $this->categorie,
                            "nr_cazuri" => $this->nr_cazuri,
                            "id_Break_Out" =>$this->id_break_out,
                            "id_categorie" =>$this->id_categorie,
                            "id_raspuns" =>$this->id_raspuns
                            ];
            $stmt->execute($insert_array);

            return $stmt;
        }


        public function update(){
            $query = "UPDATE informations SET Sample_Size = :nou_nr_cazuri
            WHERE Year = :year AND Locationdesc = :locatie AND Break_Out = :Break_Out AND  BreakoutID = :id_Break_Out AND  BreakOutCategoryID = :id_categorie AND  ResponseID = :id_raspuns ;";
            
            $stmt = $this->conn->prepare($query);

            $this->nr_cazuri = htmlspecialchars(strip_tags($this->nr_cazuri));

            $insert_array = ["year" => $this->an,
                            "locatie" => $this->locatie,
                            "Break_Out" => $this->break_out,
                            "nou_nr_cazuri" => $this->nr_cazuri,
                            "id_Break_Out" =>$this->id_break_out,
                            "id_categorie" =>$this->id_categorie,
                            "id_raspuns" =>$this->id_raspuns
                            ];
                            
            $stmt->execute($insert_array);

            return $stmt;
        }

        public function delete(){
            $query = "DELETE FROM informations WHERE Year = :year AND Locationdesc = :locatie AND Break_Out = :Break_Out AND  BreakoutID = :id_Break_Out AND  BreakOutCategoryID = :id_categorie AND  ResponseID = :id_raspuns ;";
            
            $stmt = $this->conn->prepare($query);

            $this->nr_cazuri = htmlspecialchars(strip_tags($this->nr_cazuri));

            $insert_array = ["year" => $this->an,
                            "locatie" => $this->locatie,
                            "Break_Out" => $this->break_out,
                            "id_Break_Out" =>$this->id_break_out,
                            "id_categorie" =>$this->id_categorie,
                            "id_raspuns" =>$this->id_raspuns
                            ];
                            
            $stmt->execute($insert_array);

            return $stmt;
        }
    }
?>