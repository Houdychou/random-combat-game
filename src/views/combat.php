<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen text-white">

<main class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-5xl font-extrabold text-center text-purple-400 mb-12 tracking-wide">
        ⚔️ <?= htmlspecialchars($combattant1[0]['name']) ?> VS <?= htmlspecialchars($combattant2[0]['name']) ?> ⚔️
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Combattant 1 -->
        <form method="POST" class="bg-white bg-opacity-5 rounded-2xl p-8 shadow-lg border border-indigo-500">
            <h2 class="text-3xl font-bold text-indigo-400 text-center mb-4"><?= htmlspecialchars($combattant1[0]['name']) ?></h2>
            <p class="text-center text-red-400 mb-4">
                <i class="ri-heart-3-fill mr-1 text-red-500"></i>
                Santé : <?= htmlspecialchars($combattant1[0]['sante']) ?>
            </p>
            <input type="hidden" name="attaquant" value="<?= $combattant1[0]['id'] ?? 1 ?>">

            <div class="space-y-4">
                <?php foreach ($combattant1 as $c1): ?>
                    <button type="submit" name="attaque" value="<?= htmlspecialchars($c1['aptitudeId']) ?>"
                            class="w-full flex items-center justify-between bg-indigo-700 hover:bg-indigo-800 text-white px-4 py-3 rounded-xl shadow-md transition-all">
                        <span><i class="ri-flashlight-fill mr-2 text-yellow-300"></i><?= htmlspecialchars($c1['nom']) ?></span>
                        <span class="text-sm text-indigo-200 font-semibold">-<?= $c1['note'] ?> PV</span>
                        <input type="hidden" name="damage" value="<?= $c1['note'] ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </form>

        <!-- Combattant 2 -->
        <form method="POST" class="bg-white bg-opacity-5 rounded-2xl p-8 shadow-lg border border-pink-500">
            <h2 class="text-3xl font-bold text-pink-400 text-center mb-4"><?= htmlspecialchars($combattant2[0]['name']) ?></h2>
            <p class="text-center text-red-400 mb-4">
                <i class="ri-heart-3-fill mr-1 text-red-500"></i>
                Santé : <?= htmlspecialchars($combattant2[0]['sante']) ?>
            </p>
            <input type="hidden" name="attaquant" value="<?= $combattant2[0]['id'] ?? 2 ?>">

            <div class="space-y-4">
                <?php foreach ($combattant2 as $c2): ?>
                    <button type="submit" name="attaque" value="<?= htmlspecialchars($c2['aptitudeId']) ?>"
                            class="w-full flex items-center justify-between bg-pink-700 hover:bg-pink-800 text-white px-4 py-3 rounded-xl shadow-md transition-all">
                        <span><i class="ri-flashlight-fill mr-2 text-yellow-300"></i><?= htmlspecialchars($c2['nom']) ?></span>
                        <span class="text-sm text-pink-200 font-semibold">-<?= $c2['note'] ?> PV</span>
                        <input type="hidden" name="damage" value="<?= $c2['note'] ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <div class="text-center mt-12">
        <a href="/" class="inline-block bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-full text-white font-semibold shadow-lg hover:shadow-purple-500/40 transition-all duration-300 transform hover:scale-105">
            <i class="ri-arrow-go-back-fill mr-2"></i> Retour à la sélection
        </a>
    </div>
</main>

</body>
</html>
