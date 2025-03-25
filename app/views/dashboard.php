<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            transform: translateX(4px);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="bg-primary-800 text-white w-full md:w-64 p-6 flex flex-col">
            <div class="flex items-center mb-8">
                <i class="fas fa-shield-alt text-2xl mr-3"></i>
                <h2 class="text-2xl font-bold">Admin</h2>
            </div>
            
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="sidebar-item flex items-center bg-primary-700 p-3 rounded-lg">
                            <i class="fas fa-users mr-3"></i>
                            <span>Utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-item flex items-center hover:bg-primary-700 p-3 rounded-lg">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Statistiques</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-item flex items-center hover:bg-primary-700 p-3 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="mt-auto">
                <a href="index.php?action=logout" class="sidebar-item flex items-center hover:bg-primary-700 p-3 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Gestion des utilisateurs</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Connecté en tant que: <span class="font-medium"><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span></span>
                    <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white">
                        <?= strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)) ?>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Clients</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1"><?= $clientCount ?? 0 ?></h3>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3"><span class="text-green-500">+2.5%</span> vs mois dernier</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Administrateurs</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1"><?= $adminCount ?? 0 ?></h3>
                        </div>
                        <div class="p-3 rounded-lg bg-green-50 text-green-600">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3"><span class="text-green-500">+1.2%</span> vs mois dernier</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Utilisateurs actifs</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1"><?= ($clientCount ?? 0) + ($adminCount ?? 0) ?></h3>
                        </div>
                        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3"><span class="text-green-500">+3.8%</span> vs mois dernier</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 card-hover transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nouveaux (7j)</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-1">5</h3>
                        </div>
                        <div class="p-3 rounded-lg bg-orange-50 text-orange-600">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3"><span class="text-red-500">-0.5%</span> vs semaine dernière</p>
                </div>
            </div>

            <!-- Add User Button & Form -->
            <div class="mb-8">
                <button id="showFormButton" class="flex items-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-lg transition duration-300 shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un utilisateur
                </button>

                <div id="addUserForm" class="hidden mt-6 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Ajouter un utilisateur</h2>
                    <form method="POST" action="index.php?action=addUser">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom d'utilisateur</label>
                                <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                                <select name="role_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition" required>
                                    <option value="1">Administrateur</option>
                                    <option value="2">Client</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="cancelFormButton" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-800">Liste des utilisateurs</h2>
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition text-sm">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($users)) : ?>
                                <?php foreach ($users as $user) : ?>
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($user['id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-medium">
                                                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($user['username']) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($user['email']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?= $user['role_name'] === 'Admin' ? 'bg-green-100 text-green-800' : ' text-blue-800' ?>">
                                                <?= htmlspecialchars($user['role_name']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?= $user['status'], 'bg-green-100 text-green-800' ?>">
                                                <?= htmlspecialchars($user['status']) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-3">
                                                <a href="#" class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="index.php?action=deleteUser" class="inline">
                                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']) ?>">
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Aucun utilisateur trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">10</span> sur <span class="font-medium"><?= count($users) ?></span> résultats
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Précédent
                        </button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle add user form
        const showFormButton = document.getElementById('showFormButton');
        const addUserForm = document.getElementById('addUserForm');
        const cancelFormButton = document.getElementById('cancelFormButton');

        showFormButton.addEventListener('click', () => {
            addUserForm.classList.remove('hidden'); 
            showFormButton.classList.add('hidden');
        });

        cancelFormButton.addEventListener('click', () => {
            addUserForm.classList.add('hidden');
            showFormButton.classList.remove('hidden');
        });

        // Add animation to table rows
        document.querySelectorAll('tbody tr').forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px )';
            row.style.transition = `all 0.3s ease ${index * 0.05}s`;
            
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>