<?php
require_once(__DIR__ . "/../classes/connexion.php");

global $bib_result;

$cnx = Connexion::getInstance()->getConnexion();

if ($cnx) {
    $sql = "SELECT * FROM bibliothecaires";
    $resultat = $cnx->query($sql);
    $bib_result = $resultat->rowCount();
}
