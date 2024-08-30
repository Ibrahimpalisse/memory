<?php
require '../classes/users.php'; 
require '../treatment/recup_login.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
    <div class="container mt-4">
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur :</strong> <?php echo htmlspecialchars($errorMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succès :</strong> <?php echo htmlspecialchars($_SESSION['flash_message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message']); // Clear the flash message after displaying it ?>
        <?php endif; ?>

        </br></br></br></br></br>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Connexion</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary" name="login_button">Se connecter</button>
                            <a href="register.php" class="btn btn-secondary">S'inscrire</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-4yBoA/3AA8eAA/0fOe63Xuo94ktY97B+S7R52vv03Wv59D8SoqMZ4Fdc4G4Z10wr" crossorigin="anonymous"></script>
</body>
</html>
