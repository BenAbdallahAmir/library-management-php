<?php
include(__DIR__ . "/connexion.php");

class Bibliothecaire
{
    private $id_bibliothecaire;
    private $login_bibliothecaire;
    private $mot_de_passe_bibliothecaire;

    public function __construct($id_b, $login, $mp)
    {
        $this->id_bibliothecaire = $id_b;
        $this->login_bibliothecaire = $login;
        $this->mot_de_passe_bibliothecaire = $mp;
    }

    public function ajouter()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "INSERT INTO bibliothecaires (login_bibliothecaire, mot_de_passe_bibliothecaire)
            VALUES (:login, :password)";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([
                ':login' => $this->login_bibliothecaire,
                ':password' => $this->mot_de_passe_bibliothecaire
            ]);
            if (!$res) {
                return "Insertion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function modifier()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "UPDATE bibliothecaires SET
                    login_bibliothecaire = :login,
                    mot_de_passe_bibliothecaire = :password
                    WHERE id_bibliothecaire = :id";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([
                ':login' => $this->login_bibliothecaire,
                ':password' => $this->mot_de_passe_bibliothecaire,
                ':id' => $this->id_bibliothecaire
            ]);
            if (!$res) {
                return "Update failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function supprimer()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "DELETE FROM bibliothecaires WHERE id_bibliothecaire = :id";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([':id' => $this->id_bibliothecaire]);
            if (!$res) {
                return "Deletion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public static function lister()
    {
        $tab = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM bibliothecaires ORDER BY login_bibliothecaire";
            $resultat = $cnx->query($sql);
            if ($resultat) {
                $tab = $resultat->fetchAll(PDO::FETCH_ASSOC);
                $resultat->closeCursor();
            }
        }
        return $tab;
    }

    static function lecture($id)
    {
        $res = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM bibliothecaires WHERE id_bibliothecaire = :id";
            $stmt = $cnx->prepare($sql);
            $stmt->execute([':id' => $id]);
            if ($stmt && $stmt->rowCount() == 1) {
                $adm = $stmt->fetch(PDO::FETCH_ASSOC);
                $res = new Bibliothecaire(
                    $adm["id_bibliothecaire"],
                    $adm["login_bibliothecaire"],
                    $adm["mot_de_passe_bibliothecaire"]
                );
                $stmt->closeCursor();
            }
        }
        return $res;
    }

    public function setIdBibliothecaire($id)
    {
        $this->id_bibliothecaire = $id;
    }

    public function setLoginBibliothecaire($login)
    {
        $this->login_bibliothecaire = $login;
    }

    public function setMotDePasseBibliothecaire($mot_de_passe)
    {
        $this->mot_de_passe_bibliothecaire = $mot_de_passe;
    }
}

class Genre
{
    private $id_genre;
    private $nom_genre;

    public function __construct($id_g, $nom)
    {
        $this->id_genre = $id_g;
        $this->nom_genre = $nom;
    }

    public function ajouter()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "INSERT INTO genres VALUES (:id, :nom)";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([
                ':id' => $this->id_genre,
                ':nom' => $this->nom_genre
            ]);
            if (!$res) {
                return "Insertion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function modifier()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "UPDATE genres SET
                nom_genre = :nom
                WHERE id_genre = :id";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([
                ':nom' => $this->nom_genre,
                ':id' => $this->id_genre
            ]);

            if (!$res) {
                return "Update failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function supprimer()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "DELETE FROM genres WHERE id_genre = :id";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([':id' => $this->id_genre]);
            if (!$res) {
                return "Deletion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public static function lister()
    {
        $tab = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM genres ORDER BY nom_genre";
            $resultat = $cnx->query($sql);
            if ($resultat) {
                $tab = $resultat->fetchAll(PDO::FETCH_ASSOC);
                $resultat->closeCursor();
            }
        }
        return $tab;
    }

    static function lecture($id)
    {
        $res = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM genres WHERE id_genre = :id";
            $stmt = $cnx->prepare($sql);
            $stmt->execute([':id' => $id]);
            if ($stmt && $stmt->rowCount() == 1) {
                $gen = $stmt->fetch(PDO::FETCH_ASSOC);
                $res = new Genre($gen["id_genre"], $gen["nom_genre"]);
                $stmt->closeCursor();
                $cnx = null;
            }
        }
        return $res;
    }

    // Getters
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // Setters
    public function setIdGenre($id)
    {
        $this->id_genre = $id;
    }

    public function setNomGenre($nom)
    {
        $this->nom_genre = $nom;
    }
}

class Livre
{
    private $id_livre;
    private $titre_livre;
    private $exemplaires_disponibles;
    private $isbn;
    private $id_genre;

    public function __construct($id, $titre, $exemp, $isbn, $idg)
    {
        $this->id_genre = $idg;
        $this->id_livre = $id;
        $this->exemplaires_disponibles = $exemp;
        $this->isbn = $isbn;
        $this->titre_livre = $titre;
    }

    public function ajouter()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            if ($this->id_livre === null) {
                $sql = "INSERT INTO livres (titre_livre, exemplaires_disponibles, isbn, id_genre) 
                        VALUES (:titre, :exemp, :isbn, :idg)";
                $stmt = $cnx->prepare($sql);
                $res = $stmt->execute([
                    ':titre' => $this->titre_livre,
                    ':exemp' => $this->exemplaires_disponibles,
                    ':isbn' => $this->isbn,
                    ':idg' => $this->id_genre
                ]);
            } else {
                $sql = "INSERT INTO livres (id_livre, titre_livre, exemplaires_disponibles, isbn, id_genre) 
                        VALUES (:idl, :titre, :exemp, :isbn, :idg)";
                $stmt = $cnx->prepare($sql);
                $res = $stmt->execute([
                    ':idl' => $this->id_livre,
                    ':titre' => $this->titre_livre,
                    ':exemp' => $this->exemplaires_disponibles,
                    ':isbn' => $this->isbn,
                    ':idg' => $this->id_genre
                ]);
            }

            if (!$res) {
                return "Insertion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function modifier()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "UPDATE livres SET 
                    exemplaires_disponibles = :exemp,
                    isbn = :isbn,
                    id_genre = :idg,
                    titre_livre = :titre
                    WHERE id_livre = :idl";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([
                ':idl' => $this->id_livre,
                ':exemp' => $this->exemplaires_disponibles,
                ':isbn' => $this->isbn,
                ':idg' => $this->id_genre,
                ':titre' => $this->titre_livre
            ]);
            if (!$res) {
                return "Update failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public function supprimer()
    {
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "DELETE FROM livres WHERE id_livre = :idl";
            $stmt = $cnx->prepare($sql);
            $res = $stmt->execute([':idl' => $this->id_livre]);
            if (!$res) {
                return "Deletion failed";
            } else {
                return true;
            }
        } else {
            return "Connection failed";
        }
    }

    public static function lister()
    {
        $tab = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM livres ORDER BY id_livre";
            $resultat = $cnx->query($sql);
            if ($resultat) {
                $tab = $resultat->fetchAll(PDO::FETCH_ASSOC);
                $resultat->closeCursor();
            }
        }
        return $tab;
    }
    static function lecture($id)
    {
        $res = null;
        $cnx = Connexion::getInstance()->getConnexion();
        if ($cnx) {
            $sql = "SELECT * FROM livres WHERE id_livre = :idl";
            $stmt = $cnx->prepare($sql);
            $stmt->execute([':idl' => $id]);
            if ($stmt && $stmt->rowCount() == 1) {
                $liv = $stmt->fetch(PDO::FETCH_ASSOC);
                $res = new Livre(
                    $liv["id_livre"],
                    $liv["titre_livre"],
                    $liv["exemplaires_disponibles"],
                    $liv["isbn"],
                    $liv["id_genre"]
                );
                $stmt->closeCursor();
            }
        }
        return $res;
    }
    // Getters et setters
    public function setIdLivre($id)
    {
        $this->id_livre = $id;
    }

    public function setTitreLivre($titre)
    {
        $this->titre_livre = $titre;
    }

    public function setExemplairesDisponibles($quantite)
    {
        $this->exemplaires_disponibles = $quantite;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function setIdGenre($id)
    {
        $this->id_genre = $id;
    }
}
