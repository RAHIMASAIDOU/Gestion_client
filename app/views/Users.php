<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar (identique au dashboard) -->
        <div class="bg-blue-800 text-white w-64 p-6">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <ul>
                <li class="mb-4">
                    <a href="/dashboard" class="flex items-center hover:bg-blue-700 p-2 rounded">
                        <span>Utilisateurs</span>
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
            <h1 class="text-3xl font-bold mb-8">Ajouter un utilisateur</h1>
            <form method="POST" action="/create-user" class="bg-white p-6 rounded-lg shadow">
                <div class="mb-4">
                    <label class="block text-gray-700">Nom</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Ajouter
                </button>
            </form>
        </div>
    </div>
</body>
</html>