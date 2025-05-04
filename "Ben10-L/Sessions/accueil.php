<?php
session_start();

if (!isset($_SESSION['CONNECT']) || $_SESSION['CONNECT'] !== 'OK') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <h1>Hello <?php echo htmlspecialchars($_SESSION['login']); ?></h1>
    <div class="logout">
        <a href="validation.php?afaire=deconnexion">Déconnexion</a>
    </div>
</body>
</html>
