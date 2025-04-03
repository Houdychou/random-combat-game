<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Liste des combattants</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen text-white">

<main class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-5xl font-extrabold text-center text-purple-400 mb-12 tracking-wide">
        🛡️ Liste des combattants
    </h1>

    <div class="flex flex-wrap justify-center gap-4 mb-12">
        <a href="/highestForce"
           class="flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-full shadow-lg transition">
            <i class="ri-sword-fill text-xl"></i> Force
        </a>
        <a href="/highestPv"
           class="flex items-center gap-2 bg-red-700 hover:bg-red-800 text-white px-5 py-2 rounded-full shadow-lg transition">
            <i class="ri-heart-3-fill text-xl"></i> Santé
        </a>
        <a href="/highestLevel"
           class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-full shadow-lg transition">
            <i class="ri-bar-chart-box-fill text-xl"></i> Niveau
        </a>
        <a href="/"
           class="flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white px-5 py-2 rounded-full shadow-lg transition">
            <i class="ri-refresh-line text-xl"></i> Réinitialiser
        </a>
    </div>

    <div class="text-center mb-12">
        <a href="/random-combat"
           class="inline-block bg-purple-700 px-6 py-3 rounded-full text-white font-semibold shadow-xl transition-all duration-300 transform hover:scale-105">
            <i class="ri-swords-fill mr-2"></i> Combat aléatoire
        </a>
    </div>

    <form method="POST">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-indigo-400">Choisissez deux combattants :</h2>
            <?php if (empty($_SESSION)): ?>
                <input type="submit" id="submitBtn"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-lg hover:shadow-blue-500/40 transition"
                       value="⚔️ Combattre">
            <?php elseif(!empty($_SESSION["combatId"])) : ?>
                <div>
                    <input type="submit" id="submitBtn"
                           class="bg-blue-600 cursor-pointer hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-lg transition"
                           value="⚔️ Combattre">
                    <a href="/combat"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-lg transition">⚔️
                        Revenir sur le combat précédent</a>
                </div>
            <?php endif; ?>
        </div>
        <p id="errorText" class="text-red-500 mb-4"></p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($combattant as $index => $c) : ?>
                <label>
                    <input type="checkbox" name="combattants[]" value="<?= $c["Id"] ?>" class="hidden peer">
                    <div class="peer-checked:ring-4 hover:bg-blue-900 peer-checked:ring-purple-500 bg-gray-800 shadow-xl rounded-2xl p-6 flex flex-col justify-between transition duration-300 cursor-pointer">
                        <div>
                            <h2 class="text-xl font-bold text-purple-300 mb-3"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                            <div class="space-y-1 text-gray-200 font-medium">
                                <p><i class="ri-sword-fill text-blue-400 mr-1"></i> Force : <span
                                            class="text-blue-300"><?= htmlspecialchars($c["force"]) ?></span></p>
                                <p><i class="ri-heart-3-fill text-red-400 mr-1"></i> PV : <span
                                            class="text-red-300"><?= htmlspecialchars($c["sante"]) ?></span></p>
                                <p><i class="ri-bar-chart-box-fill text-green-400 mr-1"></i> Niveau : <span
                                            class="text-green-300"><?= htmlspecialchars($c["niveau"]) ?></span></p>
                            </div>
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
