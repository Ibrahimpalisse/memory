
<?php
require_once 'jeu.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de récupération d'images</title>
</head>
<body>
    <h1>Récupération d'Images</h1>
    <form action="jeu.php" method="post">
        <label for="number_of_images">Choisissez le nombre d'images à afficher :</label>
        <select id="number_of_images" name="number_of_images" required>
            <option value="3">3</option>
            <option value="6">6</option>
            <option value="12">12</option>
            <option value="24">24</option>
        </select>
        <button type="submit">Récupérer les Images</button>
    </form>
</body>
</html>
