<?php
session_start();
class User {
    private $id;
    public $pseudo;
    public $password;
    public $email;
    private $connexion_bdd;

    public function __construct() {
        try {
            $this->connexion_bdd = new PDO('mysql:host=localhost;dbname=memory;charset=utf8', 'root', '');
            $this->connexion_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Envisagez d'utiliser un système de journalisation plutôt que d'afficher les erreurs directement
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }

    public function register($pseudo, $password, $email) {
        $query = "SELECT id FROM users WHERE pseudo = :pseudo";
        $stmt = $this->connexion_bdd->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (pseudo, password, email) VALUES (:pseudo, :password, :email)";
        $stmt = $this->connexion_bdd->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $this->id = $this->connexion_bdd->lastInsertId();
            $_SESSION['user_id'] = $this->id;
            $this->pseudo = $pseudo;
            $this->password = $passwordHash;
            $this->email = $email;
            return true;
        } else {
            return "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }

    public function login($pseudo, $password) {
        $query = "SELECT * FROM users WHERE pseudo = :pseudo";
        $stmt = $this->connexion_bdd->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $this->id = $user['id'];
            $this->pseudo = $user['pseudo'];
            $this->password = $user['password'];
            return true;
        } else {
            return false;
        }
    }

    public function getID() {
        if (isset($_SESSION['user_id'])) {
            $this->id = $_SESSION['user_id'];
        } else {
            $this->id = null;
        }
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['user_id']);
        $this->id = null;
        $this->pseudo = null;
        $this->password = null;
    }


    public function isconnected() {
        return isset($_SESSION['user_id']);
    }


    public function __destruct() {
        $this->connexion_bdd = null;
    }
}
?>
