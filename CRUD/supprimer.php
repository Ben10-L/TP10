<?php
require 'configg.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM exercice WHERE id = ?");
$stmt->execute([$id]);
$exercice = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$exercice) {
    header("Location: index.php?message=Exercice non trouvé&type=error");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmer'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM exercice WHERE id = ?");
            $stmt->execute([$id]);
            header("Location: index.php?message=Exercice supprimé avec succès&type=success");
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?message=Erreur lors de la suppression&type=error");
            exit;
        }
    } else {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un exercice</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Supprimer l'exercice</h1>

    <div class="confirmation">
        <p>Êtes-vous sûr de vouloir supprimer l'exercice suivant ?</p>
        <p><strong>Titre:</strong> <?= htmlspecialchars($exercice['titre']) ?></p>
        <p><strong>Auteur:</strong> <?= htmlspecialchars($exercice['auteur']) ?></p>
        <p><strong>Date de création:</strong> <?= $exercice['date_creation'] ?></p>

        <form method="post">
            <button type="submit" name="confirmer">Confirmer la suppression</button>
            <a href="index.php">Annuler</a>
        </form>
    </div>
</body>
</html>