<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Liste des combattants</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen font-sans">

<main class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10 drop-shadow-md">🛡️ Liste des combattants</h1>

    <div class="flex flex-wrap justify-center gap-4 mb-12">
        <a href="/highestForce"
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full shadow transition">
            <i class="ri-sword-fill"></i> Force
        </a>
        <a href="/highestPv"
           class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full shadow transition">
            <i class="ri-heart-3-fill"></i> Santé
        </a>
        <a href="/highestLevel"
           class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full shadow transition">
            <i class="ri-bar-chart-box-fill"></i> Niveau
        </a>
        <a href="/"
           class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-full shadow transition">
            <i class="ri-refresh-line"></i> Réinitialiser
        </a>
    </div>

    <div class="text-center mb-10">
        <a href="/combat"
           class="w-[300px] text-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full shadow transition">
            <i class="ri-refresh-line"></i> Combat aléatoire
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($combattant as $index => $c) : ?>
            <?php if ($_SERVER["REQUEST_URI"] === "/"): ?>
                <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col justify-between transform hover:-translate-y-1 hover:shadow-xl transition duration-300">
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-700 mb-2"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                        <div class="space-y-1 text-gray-700 font-medium">
                            <p><i class="ri-sword-fill text-blue-500 mr-1"></i> Force
                                : <?= htmlspecialchars($c["force"]) ?>
                            </p>
                            <p><i class="ri-heart-3-fill text-red-500 mr-1"></i> PV
                                : <?= htmlspecialchars($c["sante"]) ?>
                            </p>
                            <p><i class="ri-bar-chart-box-fill text-green-500 mr-1"></i> Niveau
                                : <?= htmlspecialchars($c["niveau"]) ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($_SERVER["REQUEST_URI"] === "/highestForce"): ?>
                <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col justify-between transform hover:-translate-y-1 hover:shadow-xl transition duration-300">
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-700 mb-2"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                        <div class="space-y-1 text-gray-700 font-medium">
                            <p class="font-bold"><i class="ri-sword-fill font-bold text-blue-500 mr-1"></i> Force
                                : <?= htmlspecialchars($c["force"]) ?>
                            </p>
                            <p><i class="ri-heart-3-fill text-red-500 mr-1"></i> PV
                                : <?= htmlspecialchars($c["sante"]) ?>
                            </p>
                            <p><i class="ri-bar-chart-box-fill text-green-500 mr-1"></i> Niveau
                                : <?= htmlspecialchars($c["niveau"]) ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($_SERVER["REQUEST_URI"] === "/highestPv"): ?>
                <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col justify-between transform hover:-translate-y-1 hover:shadow-xl transition duration-300">
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-700 mb-2"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                        <div class="space-y-1 text-gray-700 font-medium">
                            <p class="font-bold"><i class="ri-heart-3-fill text-red-500 mr-1"></i> PV
                                : <?= htmlspecialchars($c["sante"]) ?>
                            </p>
                            <p><i class="ri-sword-fill text-blue-500 mr-1"></i> Force
                                : <?= htmlspecialchars($c["force"]) ?>
                            </p>
                            <p><i class="ri-bar-chart-box-fill text-green-500 mr-1"></i> Niveau
                                : <?= htmlspecialchars($c["niveau"]) ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($_SERVER["REQUEST_URI"] === "/highestLevel"): ?>
                <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col justify-between transform hover:-translate-y-1 hover:shadow-xl transition duration-300">
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-700 mb-2"><?= $index + 1 . ") " . htmlspecialchars($c["nom"]) ?></h2>
                        <div class="space-y-1 text-gray-700 font-medium">
                            <p class="font-bold"><i class="ri-bar-chart-box-fill text-green-500 mr-1"></i> Niveau
                                : <?= htmlspecialchars($c["niveau"]) ?></p>
                            <p><i class="ri-heart-3-fill text-red-500 mr-1"></i> PV
                                : <?= htmlspecialchars($c["sante"]) ?>
                            </p>
                            <p><i class="ri-sword-fill text-blue-500 mr-1"></i> Force
                                : <?= htmlspecialchars($c["force"]) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>

</main>

</body>
</html>
