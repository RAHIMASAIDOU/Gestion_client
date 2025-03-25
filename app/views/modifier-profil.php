<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
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
            <h1 class="text-3xl font-bold mb-8">Modifier le profil</h1>
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Formulaire de modification -->
                <form action="index.php?action=update-profile" method="POST" class="space-y-4">
                    <div>
                        <label for="username" class="block text-gray-700 font-medium">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 font-medium">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>