<?php

namespace App\Models;

use PDO;
use PDOException;

class Register
{
    private $id_user;
    private $pdo;

    public function __construct()
    {
        // Connexion à la base de données
        $host = 'localhost'; // Remplacez par votre hôte
        $dbname = 'memory'; // Nom de la base de données
        $username = 'root'; // Nom d'utilisateur
        $password = ''; // Mot de passe

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function register($login, $email, $password)
    {
        try {
            // Vérifier si l'email existe déjà
            $checkEmail = "SELECT id_user FROM user WHERE email = :email";
            $stmtEmail = $this->pdo->prepare($checkEmail);
            $stmtEmail->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtEmail->execute();

            if ($stmtEmail->rowCount() > 0) {
                return "Cet email est déjà utilisé.";
            }

            // Vérifier si le login existe déjà
            $checkLogin = "SELECT id_user FROM user WHERE login = :login";
            $stmtLogin = $this->pdo->prepare($checkLogin);
            $stmtLogin->bindParam(':login', $login, PDO::PARAM_STR);
            $stmtLogin->execute();

            if ($stmtLogin->rowCount() > 0) {
                return "Ce login est déjà utilisé.";
            }

            // Hashage du mot de passe
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Requête d'insertion
            $insert = "INSERT INTO user (login, email, passwrd) 
                       VALUES (:login, :email, :password)";
            $stmt = $this->pdo->prepare($insert);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

            // Exécuter la requête
            if ($stmt->execute()) {
                $this->id_user = $this->pdo->lastInsertId(); // Récupérer l'ID inséré
                return true; // Succès
            }
            return "Erreur lors de l'inscription.";
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    }

    public function getId()
    {
        return intval($this->id_user);
    }
}
