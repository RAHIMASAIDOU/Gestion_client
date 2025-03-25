<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar simplifiée -->
        <div class="bg-blue-600 bg-primary-800 text-white w-20 md:w-64 p-4">
            <div class="text-center md:text-left mb-8">
                <i class="fas fa-user text-xl md:mr-2"></i>
                <span class="hidden md:inline text-xl font-bold">Profil</span>
            </div>
            
            <nav class="space-y-3">
                <a href="index.php?action=accueil" class="block p-2 rounded hover:bg-blue-500 text-center md:text-left">
                    <i class="fas fa-home md:mr-2"></i>
                    <span class="hidden md:inline">Accueil</span>
                </a>
                <a href="#" class="block p-2 rounded bg-blue-500 text-center md:text-left">
                    <i class="fas fa-user md:mr-2"></i>
                    <span class="hidden md:inline">Profil</span>
                </a>
                <a href="#" class="block p-2 rounded bg-blue-500 text-center md:text-left">
                    <i class="fas fa-user md:mr-2"></i>
                    <span class="hidden md:inline">Historique</span>
                </a>
                <a href="index.php?action=logout" class="block p-2 rounded hover:bg-blue-500 text-center md:text-left">
                    <i class="fas fa-sign-out-alt md:mr-2"></i>
                    <span class="hidden md:inline">Déconnexion</span>
                </a>
            </nav>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-6">Mon Profil</h1>
            
            <!-- Carte profil -->
            <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-6">
                    <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-3xl font-bold">
                        <?= strtoupper(substr($user['username'], 0, 1)) ?>
                    </div>
                    
                    <div class="text-center md:text-left">
                        <h2 class="text-xl font-bold"><?= htmlspecialchars($user['username']) ?></h2>
                        <p class="text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
                        <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold rounded-full 
                            <?= $user['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                            <?= htmlspecialchars($user['status'] === 'active' ? 'Actif' : 'Inactif') ?>
                        </span>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <!-- Informations -->
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date d'inscription</span>
                        <span class="font-medium"><?= htmlspecialchars(date('d/m/Y', strtotime($user['created_at']))) ?></span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dernière connexion</span>
                        <span class="font-medium">Aujourd'hui</span>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="index.php?action=modifier-profil" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center transition">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>