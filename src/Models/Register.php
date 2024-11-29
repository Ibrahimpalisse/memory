<?php

namespace App\Models;

use PDO;
use PDOException;

class Register
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $pdo;

    public function __construct()
    {
        // Connexion directe à la base de données dans le constructeur
        $host = 'localhost'; // Remplacez par votre hôte
        $dbname = 'cinetech'; // Remplacez par le nom de votre base de données
        $username = 'root'; // Nom d'utilisateur de la base
        $password = ''; // Mot de passe de la base

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function register($username, $email, $password)
    {
        try {
            // Vérifier si l'email existe déjà
            $checkEmail = "SELECT id FROM users WHERE email = :email";
            $stmtEmail = $this->pdo->prepare($checkEmail);
            $stmtEmail->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtEmail->execute();

            if ($stmtEmail->rowCount() > 0) {
                return "Cet email est déjà utilisé.";
            }

            // Hashage du mot de passe
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Requête d'insertion
            $insert = "INSERT INTO users (username, email, password) 
                       VALUES (:username, :email, :password)";
            $stmt = $this->pdo->prepare($insert);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

            // Exécuter la requête
            if ($stmt->execute()) {
                $this->id = $this->pdo->lastInsertId(); // Récupérer l'ID inséré
                $_SESSION['user_id'] = intval($this->id); // Stocker l'ID en session
                return true;
            }
            return "Erreur lors de l'inscription.";
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    }

    public function getId()
    {
        return intval($this->id);
    }
}
