<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php?action=login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-800 text-white w-64 p-6">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <ul>
                <li class="mb-4">
                    <a href="index.php?action=dashboard" class="flex items-center hover:bg-blue-700 p-2 rounded">
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="index.php?action=logout" class="flex items-center hover:bg-blue-700 p-2 rounded">
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-1 p-8">
    <h1 class="text-3xl font-bold mb-8">Gestion des utilisateurs</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Carte pour le nombre de clients -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Nombre de clients</h2>
                <p class="text-3xl font-bold text-blue-500"><?php echo $clientCount; ?></p>
            </div>

            <!-- Carte pour le nombre d'administrateurs -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Nombre d'administrateurs</h2>
                <p class="text-3xl font-bold text-green-500"><?php echo $adminCount; ?></p>
            </div>
        </div>

    <!-- Bouton pour afficher le formulaire -->
    <button id="showFormButton" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 mb-8">
        Ajouter un utilisateur
    </button>

    <!-- Formulaire pour ajouter un utilisateur (masqué par défaut) -->
    <div id="addUserForm" class="hidden mb-8">
        <h2 class="text-xl font-bold mb-4">Ajouter un utilisateur</h2>
        <form method="POST" action="index.php?action=addUser" class="bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nom d'utilisateur</label>
                <input type="text" name="username" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Rôle</label>
                <select name="role_id" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="1">Admin</option>
                    <option value="2">Client</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Ajouter
            </button>
        </form>
    </div>

    <!-- Liste des utilisateurs -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['id']); ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['username']); ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['email']); ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($user['role_name']); ?></td>
                            <td class="px-6 py-4">
                                <form method="POST" action="index.php?action=deleteUser" class="inline">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']); ?>">
                                    <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('showFormButton').addEventListener('click', function() {
        const form = document.getElementById('addUserForm');
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    });
</script>

</body>
</html>