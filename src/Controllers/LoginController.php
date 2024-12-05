<?php
namespace App\Controllers;

use App\Views\View;
use App\Models\Login;

class LoginController
{
    public function login()
    {
        $errors = [
            'identifiant' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['login']) && !empty($_POST['password'])) {
            $login = htmlspecialchars(trim($_POST['login']));
            $password = $_POST['password'];

            $loginModel = new Login();
            $result = $loginModel->login($login, $password);

            if ($result === true) { 
                header('Location:' .URL); 
                exit;
            } else {
                $errors['identifiant'] = $result; // Affiche le message d'erreur renvoyé par le modèle
            }
        }

        // Rendu de la vue avec les erreurs
        $view = new View();
        $view->render('login', ['title' => 'login', 'errors' => $errors]);
    }
}
