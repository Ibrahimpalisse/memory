<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="./public/css/style.css?<?php echo time(); ?>" rel="stylesheet" />
    <title><?= $title ?></title>
</head>

<body>
    <header>
        
          <h1>Bienvenue  <?= (isset($_SESSION['login'])) ? $_SESSION['login'] : '   Inconnu' ?></h1>
            
        
        <nav>
            <ul class="nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>profile">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>logout">Se déconnecter</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>register">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= URL ?>login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
    <script src="./public/js/search.js"></script>
</body>

</html>
