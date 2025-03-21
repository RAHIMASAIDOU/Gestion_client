<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-800 text-white w-64 p-6">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <ul>
                <li class="mb-4">
                    <a href="/dashboard" class="flex items-center hover:bg-blue-700 p-2 rounded">
                        <span>Profil</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/logout" class="flex items-center hover:bg-blue-700 p-2 rounded">
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-8">Profil Utilisateur</h1>
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Informations de l'utilisateur -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium">Nom d'utilisateur</label>
                        <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['username']); ?></p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Email</label>
                        <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['email']); ?></p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Statut</label>
                        <p class="mt-1 text-gray-900">
                            <?= htmlspecialchars($user['status'] === 'active' ? 'Actif' : 'Inactif'); ?>
                        </p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium">Date d'inscription</label>
                        <p class="mt-1 text-gray-900"><?= htmlspecialchars($user['created_at']); ?></p>
                    </div>
                </div>

                <!-- Bouton pour modifier le profil -->
                <div class="mt-6">
                    <a href="/edit-profile" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>