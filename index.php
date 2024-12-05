<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/chemin.php';

use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\LogoutControleur;

try {
    // Récupérer l'URL et extraire le chemin
    $url = $_SERVER['REQUEST_URI'];
    $path = trim(str_replace(URL, '', parse_url($url, PHP_URL_PATH)), '/');

    // Routeur simple
    switch ($path) {
        case '':
        case '/':
            // Accueil
            $controller = new HomeController();
            $controller->index();
            break;

        case 'register':
            // Page d'inscription
            $controller = new RegisterController();
            $controller->register();
            break;

        case 'login':
            // Page de connexion
            $controller = new LoginController();
            $controller->login();  
            break;  

        case 'logout':
            // Page de logout
            $controller = new LogoutControleur();
            $controller->logout();
            break;

        default:
            // Page non trouvée
            http_response_code(404);
            echo "Page non trouvée : " . htmlspecialchars($path);
            break;
    }
} catch (\Throwable $e) {
    // Gestion des erreurs globales
    http_response_code(500);
    echo "Une erreur est survenue : " . htmlspecialchars($e->getMessage());
    error_log($e->getMessage()); // Journaliser l'erreur pour le débogage
}
