<?php
include(__DIR__ . "/../classes/classes.php");

if (isset($_GET['id_livre'])) {
    $id_livre = $_GET['id_livre'];

    $cnx = Connexion::getInstance()->getConnexion();
    if ($cnx) {
        $sql = "SELECT * FROM livres WHERE id_livre = :id";
        $stmt = $cnx->prepare($sql);
        $stmt->execute([':id' => $id_livre]);

        if ($stmt && $stmt->rowCount() == 1) {
            $livre = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode([
                'success' => true,
                'id_livre' => $livre['id_livre'],
                'titre_livre' => $livre['titre_livre'],
                'exemplaires_disponibles' => $livre['exemplaires_disponibles'],
                'id_genre' => $livre['id_genre'],
                'isbn' => $livre['isbn'],
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Livre not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Connection failed.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID livre is missing.']);
}
