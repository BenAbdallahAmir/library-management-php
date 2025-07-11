<?php
include(__DIR__ . "/../classes/classes.php");

if (isset($_GET['id_genre'])) {
    $id_genre = $_GET['id_genre'];
    $genre = Genre::lecture($id_genre);

    if ($genre != null) {
        echo json_encode([
            'success' => true,
            'id_genre' => $genre->id_genre,
            'nom_genre' => $genre->nom_genre
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Genre not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID genre is missing.']);
}
