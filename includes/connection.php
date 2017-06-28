<?php
$serveur="localhost";
$dbname="odt";
$login="root";
$password="lol";

try{
    $bdd = new PDO("mysql:host=$serveur;dbname=$dbname",$login, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch(PDOException $e){
    echo "Connexion impossible" . $e->getMessage();
}
?>
