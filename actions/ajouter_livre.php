<?php
include(__DIR__ . "/../classes/classes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        empty($_POST["titre_livre"]) ||
        empty($_POST["exemplaires_disponibles"]) ||
        empty($_POST["isbn"]) ||
        empty($_POST["id_genre"])
    ) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis']);
        exit;
    }

    $exemplaires = filter_var($_POST["exemplaires_disponibles"], FILTER_VALIDATE_INT);
    $id_genre = filter_var($_POST["id_genre"], FILTER_VALIDATE_INT);

    if ($exemplaires === false || $exemplaires < 0) {
        echo json_encode(['success' => false, 'message' => 'Le nombre d\'exemplaires doit être un nombre positif']);
        exit;
    }

    if ($id_genre === false || $id_genre <= 0) {
        echo json_encode(['success' => false, 'message' => 'Genre invalide']);
        exit;
    }

    $genre = Genre::lecture($id_genre);
    if (!$genre) {
        echo json_encode(['success' => false, 'message' => 'Le genre sélectionné n\'existe pas']);
        exit;
    }

    try {
        $livre = new Livre(
            null,
            trim($_POST["titre_livre"]),
            $exemplaires,
            trim($_POST["isbn"]),
            $id_genre
        );

        $res = $livre->ajouter();

        if ($res === true) {
            echo json_encode(['success' => true, 'message' => 'Livre ajouté avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout : ' . $res]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur système : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
