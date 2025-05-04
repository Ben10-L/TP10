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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date = $_POST['date_creation'];

    try {
        $stmt = $pdo->prepare("UPDATE exercice SET titre = ?, auteur = ?, date_creation = ? WHERE id = ?");
        $stmt->execute([$titre, $auteur, $date, $id]);
        header("Location: index.php?message=Exercice modifié avec succès&type=success");
        exit;
    } catch (PDOException $e) {
        $message = "Erreur lors de la modification : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Modifier un exercice</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Modifier l'exercice</h1>

    <?php if (isset($message)): ?>
        <div class="message error"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Titre:</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($exercice['titre']) ?>" required>
        </div>
        <div class="form-group">
            <label>Auteur:</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($exercice['auteur']) ?>" required>
        </div>
        <div class="form-group">
            <label>Date de création:</label>
            <input type="date" name="date_creation" value="<?= $exercice['date_creation'] ?>" required>
        </div>
        <button type="submit" name="modifier">Enregistrer les modifications</button>
        <a href="index.php">Annuler</a>
    </form>
</body>
</html>