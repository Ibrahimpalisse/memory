<?php
$instenter_classes = new User();
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valider'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $email = $_POST['email'];


$resulta = $instenter_classes->register($pseudo, $password, $email);

if ($instenter_classes === true) {

    header('Location: index.php');
    exit();
} else{
    $errorMessage = $resulta;
    
}

}
?>