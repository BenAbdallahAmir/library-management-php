<?php
require_once(__DIR__ . "/../classes/connexion.php");

global $resultat_genre;

$cnx = Connexion::getInstance()->getConnexion();

if ($cnx) {
    $sql = "SELECT * FROM genres";
    $resultat = $cnx->query($sql);
    $resultat_genre = $resultat->rowCount();
}
