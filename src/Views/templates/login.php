<?php
$errors = $errors ?? ['identifiant' => '']; 
?>

<div class="form_container">
    <h1 class="title_movie">Connexion</h1>
    <form method="POST" class="login_form">
        <div class="form_group">
            <label for="login" class="form_label">Login</label>
            <input 
                type="text" 
                id="login" 
                name="login" 
                class="form_input" 
                placeholder="Entrez votre login" 
                value="<?php echo htmlspecialchars($_POST['login'] ?? ''); ?>" 
                required
            >
        </div>
        <div class="form_group">
            <label for="password" class="form_label">Mot de passe</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form_input" 
                placeholder="Entrez votre mot de passe" 
                required
            >
        </div>
        <?php if (!empty($errors['identifiant'])): ?>
            <p class="error text-danger"><?php echo htmlspecialchars($errors['identifiant']); ?></p>
        <?php endif; ?>
        <div class="form_group">
            <button name="submit" type="submit" class="btn">
                Se connecter
            </button>
        </div>
    </form>
</div>
