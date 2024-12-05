<?php

namespace App\Models;

use PDO;
use PDOException;

class Login
{
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

    public function login($login, $password)
    {
        // Validation des champs
        if (empty($login)) {
            return "Le champ login est vide.";
        }
        if (empty($password)) {
            return "Le champ mot de passe est vide.";
        }

        try {
            // Préparer une requête pour récupérer l'utilisateur avec son login
            $stmt = $this->pdo->prepare("SELECT id_user, login, passwrd FROM user WHERE login = :login");
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();

            // Vérifier si un utilisateur existe avec ce login
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();

                // Vérifier le mot de passe
                if (password_verify($password, $user['passwrd'])) {
                    session_start();
                    $_SESSION['user_id'] = intval($user['id_user']);
                    $_SESSION['login'] = $user['login'];
                    return true;
                } else {
                    return "Mot de passe incorrect.";
                }
            } else {
                return "Aucun utilisateur trouvé avec ce login.";
            }
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    }
}
