<?php
require 'classes/users.php'; 

$user = new User();
$user->getID();
$isConnected = $user->isconnected();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .content {
            margin-top: 20px;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .menu a:hover {
            color: #007BFF;
        }
    </style>
<body>
    <h1>
        Memory
    </h1>
    <div class="content">
        <div class="menu">
            <?php if ($isConnected): ?>
                <a href="./page/profil.php">Profil</a>
                <a href="best.php">Le Meilleur</a>
                <a href="play.php">Jouer</a>
                <a href="./treatment/logout.php">Déconnexion</a>
            <?php else: ?>
                <a href="./page/login.php">Se Connecter</a>
                <a href="./page/register.php">S'inscrire</a>
                <a href="./page/about.php">À Propos</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>