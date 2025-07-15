<?php
include(__DIR__ . "/../classes/classes.php");

$id_genre = $_GET['id_genre'];
$gen = Genre::lecture($id_genre);

if ($gen != null) {
    $res = $gen->supprimer();
    if ($res === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $res]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Genre not found.']);
}
