<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_bibliothecaire'])) {
    $id_bibliothecaire = $_GET['id_bibliothecaire'];

    $bibliothecaire = new Bibliothecaire($id_bibliothecaire, null, null);
    $res = $bibliothecaire->supprimer();

    if ($res === true) {
        echo json_encode(['success' => true, 'message' => 'Bibliothécaire supprimé avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => $res]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID bibliothécaire manquant']);
}
