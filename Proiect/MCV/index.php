<?php
session_start();

define ('SLASH', DIRECTORY_SEPARATOR);
define ('DIRECTOR_SITE', dirname(__FILE__));

require_once DIRECTOR_SITE.SLASH."config.php";
require_once DIRECTOR_SITE.SLASH."Util".SLASH."autoloader.php";



$controller = "CInformatii";
$actiune = "exprimulChart";
$parametri = "";
$locatie = 'Puerto Rico'; 
$categorie = 'Age Group';
$raspuns = 'Obese (BMI 30.0 - 99.8)';
if (isset($_GET["locatie"])) $parametri[0] = $_GET["locatie"];

if (isset($_GET["categorie"])) $parametri[1] = $_GET["categorie"];

if (isset($_GET["raspuns"])) $parametri[2] = $_GET["raspuns"];

if ($actiune == "primulChart"){
    $parametri = array($locatie,$categorie,$raspuns);
}

if ($actiune == "stergeMesaj"){
    $parametri = array($_POST["id"]);
}

if ($actiune=="triggerModificaMesaj"){
    $parametri = array($_POST["id"]);
}

if ($actiune=="salveazaMesaj"){
    $parametri = array($_POST["id"], $_POST["mesaj"]);
}

$control = new $controller($actiune, $parametri);

?>