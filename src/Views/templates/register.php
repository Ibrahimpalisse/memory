<?php

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [
    'nom' => '',
    'prenom' => '',
    'email' => '',
    'tel' => '',
    'password' => '',
    'confirm_password' => ''
];

?>
<div class="form_container">
    <h1 class="title_movie">Inscription</h1>
    <form  method="POST" class="registration_form">
    <span class="error text-danger"><?php echo isset($errors['general']) ? htmlspecialchars($errors['general']) : ''; ?></span>

        <div class="form_group">
            <label for="username" class="form_label">Nom d'utilisateur</label>
            <input type="text" id="login" name="login" class="form_input"  value="<?php echo isset($_SESSION['login']) ? htmlspecialchars($_SESSION['login']) : ''; ?>">
             <span class="error text-danger"><?php echo isset($errors['login']) ? htmlspecialchars($errors['login']) : ''; ?></span>

        </div>
        <div class="form_group">
            <label for="email" class="form_label">Email</label>
            <input type="email" id="email" name="email" class="form_input"  value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
            <span class="error text-danger"><?php echo isset($errors['email']) ? htmlspecialchars($errors['email']) : '';?></span>

        </div>
        <div class="form_group">
            <label for="password" class="form_label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form_input"  value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>">
            <span class="error text-danger"><?php echo isset($errors['password']) ? htmlspecialchars($errors['password']) : ''; ?></span>

        </div>
        <div class="form_group">
            <label for="confirm_password" class="form_label">Confirmez le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form_input" placeholder="Confirmez votre mot de passe" required>
            <span class="error text-danger"><?php echo isset($errors['confirm_password']) ? htmlspecialchars($errors['confirm_password']) : ''; ?></span>
        </div>
        <div class="form_group">
            <button name="register" type="submit" class="btn">
                S'inscrire
            </button>
        </div>
    </form>
</div>
