<?php
include(__DIR__ . "/../classes/classes.php");

$livre = Livre::lecture($_GET["id_livre"]);
if ($livre != null) {
    $res = $livre->supprimer();
    if ($res === true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $res]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Livre non trouvé']);
}
