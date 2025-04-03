<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
        }

        .vs-text {
            animation: pulseVs 1s infinite alternate;
        }

        @keyframes pulseVs {
            0% { opacity: 1; transform: scale(1); }
            100% { opacity: 0.6; transform: scale(1.2); }
        }

        main {
            animation: fadeInMain 1.5s ease-in;
        }

        @keyframes fadeInMain {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-black via-gray-950 to-gray-900 min-h-screen text-white relative">

<main class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-6xl font-extrabold text-center text-red-600 mb-14 tracking-widest drop-shadow-[0_0_30px_rgba(255,0,0,0.7)]">
        <span class="text-orange-500 animate-pulse"><?= htmlspecialchars($combattant1[0]['name']) ?></span>
        <span class="vs-text mx-6 text-5xl text-gray-100 drop-shadow-[0_0_15px_rgba(255,255,255,0.5)]">VS</span>
        <span class="text-blue-500 animate-pulse"><?= htmlspecialchars($combattant2[0]['name']) ?></span>
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <form method="POST" class="bg-gradient-to-br from-gray-900 to-black rounded-2xl p-8 shadow-[0_0_25px_#dc2626] border-2 border-red-700 hover:border-red-500 transition">
            <input type="hidden" class="sante" value="<?= htmlspecialchars($combattant1[0]['sante']) ?>">
            <h2 class="text-4xl font-bold text-orange-400 text-center mb-4"><?= htmlspecialchars($combattant1[0]['name']) ?></h2>
            <p class="text-center text-red-300 text-xl mb-6 health">
                <i class="ri-heart-3-fill mr-1 text-red-600"></i>Santé :
                <?= htmlspecialchars($combattant1[0]['sante']) ?>
            </p>

            <input type="hidden" class="attaquant" name="attaquant" value="<?= $combattant1[0]['id'] ?>">
            <input type="hidden" class="opponent" name="opponent" value="<?= $combattant2[0]['id'] ?>">

            <div class="space-y-4">
                <?php foreach ($combattant1 as $c1): ?>
                    <button type="submit" name="attaque" value="<?= htmlspecialchars($c1['aptitudeId']) ?>"
                            class="w-full attaque flex items-center justify-between bg-red-800 hover:bg-red-900 text-white px-5 py-3 rounded-xl shadow-lg transition-all duration-300">
                        <span><i class="ri-sword-fill mr-2 text-yellow-300"></i><?= htmlspecialchars($c1['nom']) ?></span>
                        <span class="text-sm text-red-200 font-semibold">-<?= $c1['note'] ?> PV</span>
                        <input type="hidden" class="damage" name="damage" value="<?= $c1['note'] ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </form>

        <form method="POST" class="bg-gradient-to-br from-gray-900 to-black rounded-2xl p-8 shadow-[0_0_25px_#3b82f6] border-2 border-blue-700 hover:border-blue-500 transition">
            <input type="hidden" class="sante" value="<?= htmlspecialchars($combattant2[0]['sante']) ?>">
            <h2 class="text-4xl font-bold text-blue-400 text-center mb-4"><?= htmlspecialchars($combattant2[0]['name']) ?></h2>
            <p class="text-center text-blue-200 text-xl mb-6 health">
                <i class="ri-heart-3-fill mr-1 text-red-600"></i>Santé :
                <?= htmlspecialchars($combattant2[0]['sante']) ?>
            </p>

            <input type="hidden" class="attaquant" name="attaquant" value="<?= $combattant2[0]['id'] ?>">
            <input type="hidden" class="opponent" name="opponent" value="<?= $combattant1[0]['id'] ?>">

            <div class="space-y-4">
                <?php foreach ($combattant2 as $c2): ?>
                    <button type="submit" name="attaque" value="<?= htmlspecialchars($c2['aptitudeId']) ?>"
                            class="w-full attaque flex items-center justify-between bg-blue-800 hover:bg-blue-900 text-white px-5 py-3 rounded-xl shadow-lg transition-all duration-300">
                        <span><i class="ri-sword-fill mr-2 text-yellow-300"></i><?= htmlspecialchars($c2['nom']) ?></span>
                        <span class="text-sm text-blue-100 font-semibold">-<?= $c2['note'] ?> PV</span>
                        <input type="hidden" class="damage" name="damage" value="<?= $c2['note'] ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </form>
    </div>

    <div class="text-center mt-14">
        <a href="/"
           class="inline-block bg-red-700 hover:bg-red-800 px-6 py-4 rounded-full text-white text-xl font-bold shadow-lg hover:shadow-red-500/50 transition-all transform hover:scale-110">
            <i class="ri-arrow-go-back-fill mr-2"></i> Retour à la sélection
        </a>
    </div>
</main>

<script src="/public/js/combat.js"></script>
</body>
</html>
