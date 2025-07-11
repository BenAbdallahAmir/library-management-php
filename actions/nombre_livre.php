<?php
require_once(__DIR__ . "/../classes/connexion.php");

global $resultat_livre;

$cnx = Connexion::getInstance()->getConnexion();

if ($cnx) {
    $sql = "SELECT * FROM livres";
    $resultat = $cnx->query($sql);
    $resultat_livre = $resultat->rowCount();
}
