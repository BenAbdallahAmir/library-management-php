<?php
include(__DIR__ . "/../classes/classes.php");

if (isset($_GET['id_admin'])) {
    $id_bibliothecaire = $_GET['id_admin'];

    $cnx = Connexion::getInstance()->getConnexion();
    if ($cnx) {
        $sql = "SELECT * FROM bibliothecaires WHERE id_bibliothecaire = :id";
        $stmt = $cnx->prepare($sql);
        $stmt->execute([':id' => $id_bibliothecaire]);

        if ($stmt && $stmt->rowCount() == 1) {
            $bibliothecaire = $stmt->fetch(PDO::FETCH_ASSOC);

            echo json_encode([
                'success' => true,
                'id_admin' => $bibliothecaire['id_bibliothecaire'],
                'login' => $bibliothecaire['login_bibliothecaire'],
                'mot_de_passe' => $bibliothecaire['mot_de_passe_bibliothecaire']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Bibliothécaire non trouvé']);
        }
        $stmt->closeCursor();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID bibliothécaire manquant']);
}
