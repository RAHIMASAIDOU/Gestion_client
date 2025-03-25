<?php
require_once "../models/Session.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    echo "Accès interdit.";
    exit;
}

$sessions = Session::getUserHistory($_SESSION["user_id"]);
?>

<h2>Historique de connexions</h2>
<table border="1">
    <tr>
        <th>Date et heure de connexion</th>
        <th>Date et heure de déconnexion</th>
    </tr>
    <?php foreach ($sessions as $session): ?>
        <tr>
            <td><?= $session["login_time"] ?></td>
            <td><?= $session["logout_time"] ?: "Toujours connecté" ?></td>
        </tr>
    <?php endforeach; ?>
</table>
