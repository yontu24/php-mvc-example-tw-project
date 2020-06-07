<?php
class BD
{
    private static $conexiune_bd = NULL;
    public static function obtine_conexiune(){
        if (is_null(self::$conexiune_bd))
        {
            self::$conexiune_bd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            //self::$conexiune_bd = new PDO('mysql:host=localhost;dbname=proiectTW','root','');

        }
        return self::$conexiune_bd;
    }
}

class MInformatii
{
    public function getInformatii($locatie, $categorie, $raspuns){
        $sql = "SELECT distinct * FROM informations WHERE Locationdesc = :locatie and Break_Out_Category = :categorie and Response = :raspuns ORDER by BreakoutID , Year;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute([
            'locatie' => $locatie,
            'categorie' => $categorie,
            'raspuns' => $raspuns
        ]);
        return $cerere->fetchAll();
    }
}

// $test = new MInformatii();
// $test -> getInformatii('Puerto Rico','Age Group','Obese (BMI 30.0 - 99.8)');
?>