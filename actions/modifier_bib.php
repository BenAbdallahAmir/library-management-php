<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["id_admin"]) || empty($_POST["login"]) || empty($_POST["mot_de_passe"])) {
        echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs requis.']);
        exit;
    } else {
        $bibliothecaire = new Bibliothecaire(
            $_POST["id_admin"],
            $_POST["login"],
            $_POST["mot_de_passe"]
        );

        $res = $bibliothecaire->modifier();

        if ($res === true) {
            echo json_encode(['success' => true, 'message' => 'Bibliothécaire modifié avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => $res]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
