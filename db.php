<?php


 $requete = "SELECT * FROM config limit 1";
global $dbh;
 // connection to the database
 try {
 $dbh = new PDO('mysql:host=localhost;dbname=rplayer', 'root', '');
 //$dbh = new PDO('mysql:host=localhost;dbname=recticar', 'root', '');
 } catch(Exception $e) {
  exit("Error conectando al Servidor");
 }
 // Execute the query
 $resultat = $dbh->query($requete) or die(print_r($dbh->errorInfo()));



?>
