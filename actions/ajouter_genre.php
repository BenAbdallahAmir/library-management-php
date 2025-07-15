<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["id_genre"]) || empty($_POST["nom_genre"])) {
        echo json_encode(['success' => false, 'message' => 'Un ou plusieurs champs ne sont pas remplis']);
        exit;
    } else {
        $gen = new Genre($_POST["id_genre"], $_POST["nom_genre"]);
        $res = $gen->ajouter();

        if ($res === true) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $res]);
        }
    }
}
