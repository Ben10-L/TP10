<?php
require 'configg.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date = $_POST['date_creation'];

    try {
        $stmt = $pdo->prepare("INSERT INTO exercice (titre, auteur, date_creation) VALUES (?, ?, ?)");
        $stmt->execute([$titre, $auteur, $date]);
        $message = "Exercice ajouté avec succès!";
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout : " . $e->getMessage();
    }
}

$exercices = $pdo->query("SELECT * FROM exercice ORDER BY date_creation DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des exercices</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestion des exercices</h1>

    <?php if (isset($_GET['message'])): ?>
        <div class="message <?php echo $_GET['type']; ?>"><?php echo $_GET['message']; ?></div>
    <?php endif; ?>

    <h2>Ajouter un exercice</h2>
    <form method="post">
        <div class="form-group">
            <label>Titre:</label>
            <input type="text" name="titre" required>
        </div>
        <div class="form-group">
            <label>Auteur:</label>
            <input type="text" name="auteur" required>
        </div>
        <div class="form-group">
            <label>Date de création:</label>
            <input type="date" name="date_creation" required>
        </div>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h2>Liste des exercices</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercices as $exercice): ?>
            <tr>
                <td><?= $exercice['id'] ?></td>
                <td><?= htmlspecialchars($exercice['titre']) ?></td>
                <td><?= htmlspecialchars($exercice['auteur']) ?></td>
                <td><?= $exercice['date_creation'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $exercice['id'] ?>">Modifier</a> | 
                    <a href="supprimer.php?id=<?= $exercice['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exercice?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>