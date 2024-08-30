<?php
$user = new User();
$errorMessage = '';
$successMessage = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_button'])) {
    $login = $_POST['pseudo'];
    $password = $_POST['password'];

    if ($user->login($login, $password)) {
        $_SESSION['flash_message'] = 'Connexion réussie';
        header('Location: ../index.php');
        exit(); 
    } else {
        $errorMessage = 'Identifiant ou mot de passe incorrect.';
    }
}
?>