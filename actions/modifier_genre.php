<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["id_genre"]) || empty($_POST["nom_genre"])) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    } else {
        $id_genre = $_POST["id_genre"];
        $nom_genre = $_POST["nom_genre"];

        $gen = new Genre($id_genre, $nom_genre);
        $res = $gen->modifier();

        if ($res === true) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $res]);
        }
    }
}
