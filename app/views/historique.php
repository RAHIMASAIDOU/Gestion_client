<?php
require_once __DIR__ . '/../models/Session.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: /login.php");
    exit;
}

// Récupérer l'historique des connexions de l'utilisateur
$sessions = Session::getUserSessions($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des connexions</title>
</head>
<body>
    <h2>Historique de connexion</h2>
    <table border="1">
        <tr>
            <th>Date de connexion</th>
            <th>Date de déconnexion</th>
        </tr>
        <?php foreach ($sessions as $session): ?>
            <tr>
                <td><?= htmlspecialchars($session["login_time"]); ?></td>
                <td><?= $session["logout_time"] ? htmlspecialchars($session["logout_time"]) : "Toujours connecté"; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php?action=profile">Retour au profil</a>
</body>
</html>
