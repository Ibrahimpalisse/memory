<?php
namespace App\Controllers;


use App\Views\View;
use App\Models\Register;

class RegisterController {
    
    public function register() {
        // Initialisation des erreurs
        $errors = [
            'login' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'general' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            // Récupération des données utilisateur avec nettoyage
            $login = htmlspecialchars(trim($_POST['login'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Définition des regex pour validation
            $loginRegex = "/^[A-Z][a-zà-öø-ÿ-]+$/";
            $emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            $passwordRegex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";

            // Validation du login
            if (empty($login) || !preg_match($loginRegex, $login)) {
                $errors['login'] = "Le login doit commencer par une majuscule et ne contenir que des lettres.";
            } else {
                $_SESSION['login'] = $login;
            }

            // Validation de l'email
            if (empty($email) || !preg_match($emailRegex, $email)) {
                $errors['email'] = "Veuillez entrer un email valide.";
            } else {
                $_SESSION['email'] = $email;
            }

            // Validation du mot de passe
            if (empty($password) || !preg_match($passwordRegex, $password)) {
                $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial.";
            }

            // Validation de la confirmation du mot de passe
            if ($password !== $confirm_password) {
                $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
            }

            // Vérification finale des erreurs
            if (empty(array_filter($errors))) {
                // Appel du modèle pour enregistrer l'utilisateur
                $registerModel = new Register();
                $result = $registerModel->register($login, $email, $password);

                if ($result === true) {
                    // Suppression des erreurs et des données de session
                    unset($_SESSION['errors'], $_SESSION['login'], $_SESSION['email']);
                    header('Location: ' . URL . './login');
                    exit;
                } else {
                    // Ajout d'une erreur générale si l'inscription échoue
                    $errors['general'] = $result;
                }
            }

            // Stockage des erreurs en session
            $_SESSION['errors'] = $errors;
        }

        // Rendu de la vue d'inscription
        $view = new View();
        $view->render('register', ['title' => 'register', 'errors' => $errors]);
    }
}
