<?php
session_start();
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Connexion</h1>
    
    <?php if ($error == 1): ?>
        <div class="error">Veuillez saisir un login et un mot de passe</div>
    <?php elseif ($error == 2): ?>
        <div class="error">Erreur de login/mot de passe</div>
    <?php elseif ($error == 3): ?>
        <div class="error">Vous avez été déconnecté du service</div>
    <?php endif; ?>
    
    <form action="validation.php" method="post">
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login">
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password">
        </div>
        
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>