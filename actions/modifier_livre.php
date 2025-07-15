<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        empty($_POST["id_livre"]) ||
        empty($_POST["titre_livre"]) ||
        empty($_POST["exemplaires_disponibles"]) ||
        empty($_POST["isbn"]) ||
        empty($_POST["id_genre"])
    ) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis']);
        exit;
    }

    $id_livre = filter_var($_POST['id_livre'], FILTER_VALIDATE_INT);
    $titre_livre = trim($_POST['titre_livre']);
    $exemplaires_disponibles = filter_var($_POST['exemplaires_disponibles'], FILTER_VALIDATE_INT);
    $isbn = trim($_POST['isbn']);
    $id_genre = filter_var($_POST['id_genre'], FILTER_VALIDATE_INT);

    if ($id_livre === false || $id_livre <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID livre invalide']);
        exit;
    }

    if ($exemplaires_disponibles === false || $exemplaires_disponibles < 0) {
        echo json_encode(['success' => false, 'message' => 'Le nombre d\'exemplaires doit être un nombre positif']);
        exit;
    }

    if ($id_genre === false || $id_genre <= 0) {
        echo json_encode(['success' => false, 'message' => 'Genre invalide']);
        exit;
    }

    $livre_existant = Livre::lecture($id_livre);
    if (!$livre_existant) {
        echo json_encode(['success' => false, 'message' => 'Livre non trouvé']);
        exit;
    }

    $genre = Genre::lecture($id_genre);
    if (!$genre) {
        echo json_encode(['success' => false, 'message' => 'Le genre sélectionné n\'existe pas']);
        exit;
    }

    try {
        $livre = new Livre($id_livre, $titre_livre, $exemplaires_disponibles, $isbn, $id_genre);
        $res = $livre->modifier();

        if ($res === true) {
            echo json_encode(['success' => true, 'message' => 'Livre modifié avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification : ' . $res]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur système : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
