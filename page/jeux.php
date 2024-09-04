<?php
require '../classes/users.php';
$instenter_classes = new User();
$authentification = $instenter_classes->isconnected();

if (!$authentification) {
    header('Location: login.php');
    exit();
}
require_once '../classes/Carte.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['number_of_images'])) {
    $game = new Carte();

    $numberOfImages = intval($_POST['number_of_images']);
    $validNumbers = [3, 6, 12, 24];

    if (!in_array($numberOfImages, $validNumbers)) {
        echo "Nombre d'images invalide.";
        exit;
    }
    
    $imageIds = range(1, $numberOfImages);
    $imagesFromDB = $game->getImages($imageIds);
    
    // Mélanger les images   
    $shuffledImages = $game-> shuffleImages($imagesFromDB);
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/css_jeux.css?t=<?= time() ?>">
    </head>
    <body>
        <div class="container">
            <?php
            // Chemin de votre image de couverture
            $coverImage = '../assets/bckgrend_carte/bckgrend_carte3.jpg';
    
            // Affichage des cartes pour chaque image mélangée
            foreach ($shuffledImages as $image) {
                echo "<div class='card' onclick='this.classList.toggle(\"flipped\")'>";
                echo "<div class='card-inner'>";
                echo "<div class='card-front'>";
                echo "<img src='$coverImage' alt='Cover Image' />";
                echo "</div>";
                echo "<div class='card-back'>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="Image" />';
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </body>
    </html>
    
    <?php
} else {
    echo "Aucun nombre d'images spécifié.";
}
?>
