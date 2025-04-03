<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Liste des combattants</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
            background: radial-gradient(circle at center, #111 0%, #000 100%);
        }

        .combat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .combat-card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.2);
        }

        .intro-text {
            animation: fadeIn 2s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="min-h-screen text-white">

<main class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10 intro-text">
        <p class="text-xl text-gray-300 mb-2 tracking-wide">Bienvenue à l’arène.</p>
        <p class="text-lg text-gray-400">Sélectionnez vos champions... et préparez-vous au combat.</p>
    </div>

    <h1 class="text-5xl font-extrabold text-center text-red-500 mb-12 tracking-widest">
        ⚔️ Sélection des combattants
    </h1>

    <div class="flex flex-wrap justify-center gap-4 mb-10">
        <a href="/highestForce" class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-5 py-2 rounded-full shadow transition transform hover:scale-105">
            <i class="ri-sword-fill text-xl"></i> Force
        </a>
        <a href="/highestLevel" class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-5 py-2 rounded-full shadow transition transform hover:scale-105">
            <i class="ri-bar-chart-box-fill text-xl"></i> Niveau
        </a>
        <a href="/" class="flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white px-5 py-2 rounded-full shadow transition transform hover:scale-105">
            <i class="ri-refresh-line text-xl"></i> Réinitialiser
        </a>
    </div>

    <div class="text-center mb-10">
        <a href="/random-combat" class="inline-block bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-full text-white text-xl shadow-md transition-all transform hover:scale-105">
            <i class="ri-swords-fill mr-2"></i> Combat aléatoire
        </a>
    </div>

    <form method="POST">
        <div class="flex justify-between items-center mb-6 flex-col md:flex-row gap-4">
            <h2 class="text-3xl font-bold text-gray-200">🎯 Choisissez deux combattants</h2>
            <?php if (empty($_SESSION)): ?>
                <input type="submit" id="submitBtn" class="bg-red-700 cursor-pointer hover:bg-red-800 text-white px-6 py-3 text-lg rounded-lg shadow-md transition transform hover:scale-105" value="Lancer le combat">
            <?php elseif(!empty($_SESSION["combatId"])) : ?>
                <div class="flex flex-wrap gap-4">
                    <input type="submit" id="submitBtn" class="bg-red-700 cursor-pointer hover:bg-red-800 text-white px-6 py-3 text-lg rounded-lg shadow-md transition transform hover:scale-105" value="Lancer le combat">
                    <a href="/combat" class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-3 text-lg rounded-lg shadow-md transition transform hover:scale-105">
                        Combat précédent
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <p id="errorText" class="text-red-500 mb-6 text-lg"></p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($combattant as $index => $c) : ?>
                <label>
                    <input type="checkbox" name="combattants[]" value="<?= $c["Id"] ?>" class="hidden peer">
                    <div class="combat-card peer-checked:ring-4 peer-checked:ring-red-500 bg-gray-900 hover:bg-gray-800 rounded-2xl p-6 transition duration-300 cursor-pointer shadow">
                        <h2 class="text-2xl font-bold text-gray-100 mb-4"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                        <div class="space-y-2 text-gray-300 text-lg">
                            <p><i class="ri-sword-fill text-red-400 mr-1"></i> Force : <span><?= htmlspecialchars($c["force"]) ?></span></p>
                            <p><i class="ri-heart-3-fill text-green-400 mr-1"></i> PV : <span><?= htmlspecialchars($c["sante"]) ?></span></p>
                            <p><i class="ri-bar-chart-box-fill text-blue-400 mr-1"></i> Niveau : <span><?= htmlspecialchars($c["niveau"]) ?></span></p>
                        </div>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>
    </form>
</main>

<script src="/public/js/script.js"></script>
</body>
</html>
