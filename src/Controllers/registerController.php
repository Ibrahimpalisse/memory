<?php
namespace App\Controllers;

session_start();

use App\Views\View;
use App\Models\Register;

class registerController {
    
    public function register() {
        $errors = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            $nom = htmlspecialchars(trim($_POST['login'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $nomRegex = "/^[A-Z][a-zà-öø-ÿ-]+$/";
            $emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            $passwordRegex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";

            // Validation des champs
            if (empty($nom) || !preg_match($nomRegex, $nom)) {
                $errors['login'] = "Le nom doit commencer par une majuscule et ne contenir que des lettres.";
            } else {
                $_SESSION['login'] = $nom;            
            }

            if (empty($email) || !preg_match($emailRegex, $email)) {
                $errors['email'] = "Veuillez entrer un email valide.";
            } else {
                $_SESSION['email'] = $email;            
            }

            if (empty($password) || !preg_match($passwordRegex, $password)) {
                $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial.";
            }

            if ($password !== $confirm_password) {
                $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
            }

        
            if (empty(array_filter($errors))) {
       
                $registerModel = new Register();
                $result = $registerModel->register($nom, $email, $password);

                if ($result === true) {
                    unset($_SESSION['errors'], $_SESSION['login'], $_SESSION['email']);
                    header('Location: <?php echo BASE_URL; ?>/login');
                    exit;
                } else {
                    $errors['general'] = $result;
                }
            }

        
            $_SESSION['errors'] = $errors;
        }

        $view = new View();
        $view->render('register');
    }
}
