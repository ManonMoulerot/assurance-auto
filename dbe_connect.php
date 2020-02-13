<?php

try {
$connection = new PDO('mysql:host=localhost;dbname=bd_assurance_auto', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


//$dbh = null; 
//retourne pas de résultat donc on créer des exceptions 
} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}

?>
