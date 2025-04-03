<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Combat aléatoire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Bebas Neue', sans-serif;
        }

        .vs-flash {
            animation: flash 1s infinite alternate;
        }

        @keyframes flash {
            from { opacity: 1; }
            to { opacity: 0.3; }
        }

        /* ✅ Animation intro */
        .intro-screen {
            position: fixed;
            inset: 0;
            background-color: black;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
            animation: fadeOut 3s forwards;
        }

        .intro-screen h1 {
            font-size: 3.5rem;
            color: #facc15;
            text-shadow: 0 0 20px rgba(255, 255, 0, 0.7);
            animation: zoomIn 1s ease-in-out;
        }

        @keyframes zoomIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }

        /* ✅ Apparition douce */
        main {
            animation: fadeIn 1.2s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-black via-gray-900 to-gray-800 min-h-screen text-white py-10 px-4 relative">

<!-- ✅ Intro animée -->
<div class="intro-screen">
    <h1>⚡ Combat aléatoire lancé !</h1>
</div>

<main>
    <h1 class="text-6xl font-extrabold text-center text-purple-500 mb-14 tracking-widest drop-shadow-[0_0_20px_rgba(128,0,255,0.6)]">
        <span class="text-red-500 animate-pulse"><?= htmlspecialchars($c1["nom"]) ?></span>
        <span class="vs-flash text-white mx-6 text-4xl">VS</span>
        <span class="text-blue-400 animate-pulse"><?= htmlspecialchars($c2["nom"]) ?></span>
    </h1>

    <div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl shadow-2xl border border-gray-700 p-8 mb-10">
        <h3 class="text-3xl font-semibold text-indigo-400 mb-6 flex items-center gap-2">
            <i class="ri-scroll-fill text-indigo-400"></i> Déroulement du combat
        </h3>
        <ul class="list-disc pl-6 space-y-2 text-gray-300 max-h-[300px] overflow-y-auto">
            <?php foreach ($commentaries as $entry): ?>
                <li><?= htmlspecialchars($entry); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php if ($endCombat): ?>
            <p class="text-center mt-6 text-[26px] text-green-400 font-bold tracking-wider"><?= htmlspecialchars($endCombat); ?></p>
        <?php endif ?>
    </div>

    <div class="text-center mb-10">
        <p class="text-4xl font-bold text-yellow-400 drop-shadow-[0_0_10px_rgba(255,255,0,0.5)]">🏆 Vainqueur : <?= htmlspecialchars($vainqueur["nom"]) ?></p>
    </div>

    <h2 class="text-center text-[32px] mb-8 text-purple-400 font-bold">🔍 Après-combat</h2>

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <?php if ($vainqueur) : ?>
            <div class="bg-gray-800 rounded-xl shadow-xl p-6 border-2 border-green-500">
                <h2 class="text-2xl font-bold text-green-400 mb-3 uppercase"><?= htmlspecialchars($vainqueur["nom"]) ?></h2>
                <p>📈 Niveau : <span class="font-semibold"><?= $vainqueur["niveau"] ?></span><span class="text-green-400"> +<?= $gainNiveau; ?></span></p>
            </div>
        <?php endif; ?>

        <?php if ($perdant) : ?>
            <div class="bg-gray-800 rounded-xl shadow-xl p-6 border-2 border-red-500">
                <h2 class="text-2xl font-bold text-red-400 mb-3 uppercase"><?= htmlspecialchars($perdant["nom"]) ?></h2>
                <p>📈 Niveau : <span class="font-semibold text-red-300"><?= $perdant["niveau"] ?></span></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center">
        <a href="/" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-full shadow-lg hover:shadow-blue-500/40 transition transform hover:scale-105">
            <i class="ri-arrow-left-line"></i> Retour à la liste des combattants
        </a>
        <a href="/random-combat" class="inline-flex items-center gap-2 px-6 py-3 bg-green-700 hover:bg-green-800 text-white rounded-full shadow-lg hover:shadow-green-500/40 transition transform hover:scale-105 ms-4">
            <i class="ri-loop-right-line"></i> Refaire un combat aléatoire
        </a>
    </div>
</main>

</body>
</html>
