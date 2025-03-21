<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>
        <form action='index.php?action=login' method='POST'>
        <div class="mb-4">
                <label class="block text-gray-700 font-medium">username</label>
                <input type="name" name="username" id="username" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="exemple@email.com">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Se connecter
            </button>
        </form>
        <p class="mt-4 text-center text-gray-600">Vous n'avez pas de compte ? <a href="index.php?action=register" class="text-blue-500 hover:underline">Inscrivez-vous</a></p>
    </div>
</body>
</html>