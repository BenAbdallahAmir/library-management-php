<?php
session_start();
include(__DIR__ . "/../classes/connexion.php");

if (isset($_POST['login_bibliothecaire']) && isset($_POST['mot_de_passe_bibliothecaire'])) {
    $login = $_POST['login_bibliothecaire'];
    $pwd = $_POST['mot_de_passe_bibliothecaire'];

    if (empty($login)) {
        $_SESSION['error_message'] = "The 'Login' field cannot be empty.";
        $_SESSION['login_error'] = true;
        header("Location: index.php");
        exit();
    }

    if (empty($pwd)) {
        $_SESSION['error_message'] = "The 'Password' field cannot be empty.";
        $_SESSION['password_error'] = true;
        header("Location: index.php");
        exit();
    }

    $cnx = Connexion::getInstance()->getConnexion();

    $req = "SELECT * FROM bibliothecaires WHERE login_bibliothecaire = :login AND mot_de_passe_bibliothecaire = :pwd";
    $stmt = $cnx->prepare($req);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->execute();

    if ($stmt->rowCount() == 1) { 
        $enreg = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION["user"] = $enreg["login_bibliothecaire"];
        $_SESSION["password"] = $enreg["mot_de_passe_bibliothecaire"];

        header("Location: ../views/espace_bib.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Incorrect login or password.";
        $_SESSION['login_error'] = true;
        $_SESSION['password_error'] = true;

        header("Location: index.php");
        exit();
    }
}
