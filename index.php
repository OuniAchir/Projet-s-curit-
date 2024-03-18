<?php

$servername= "localhost";
$username="root";
$password="";

try{
    $conn = new PDO ("mysql:host=$servername; $dbname=devoir_securite", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo"Connexion réussie";
}catch(PDOException $e){
    echo "Erreur de connexion".$e->getMessage();
}

?>