<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Combat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen text-white py-10 px-4">

<h1 class="text-5xl font-extrabold text-center text-purple-400 mb-10 tracking-wide">
    ⚔️ Combat : <span class="text-blue-400"><?= htmlspecialchars($c1["nom"]) ?></span> vs <span class="text-red-400"><?= htmlspecialchars($c2["nom"]) ?></span>
</h1>

<div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl shadow-lg border border-gray-700 p-8 mb-10">
    <h3 class="text-3xl font-semibold text-indigo-400 mb-6 flex items-center gap-2"><i class="ri-scroll-fill text-indigo-400"></i> Déroulement du combat</h3>
    <ul class="list-disc pl-6 space-y-2 text-gray-300 max-h-[300px] overflow-y-auto">
        <?php foreach ($commentaries as $entry): ?>
            <li><?= htmlspecialchars($entry); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php if ($endCombat): ?>
        <p class="text-center mt-6 text-[24px] text-green-400 font-bold"><?= htmlspecialchars($endCombat); ?></p>
    <?php endif ?>
</div>

<div class="text-center mb-10">
    <p class="text-3xl font-bold text-yellow-400">🏆 Vainqueur : <?= htmlspecialchars($vainqueur["nom"]) ?></p>
</div>

<h2 class="text-center text-[32px] mb-8 text-purple-400 font-bold">🔍 Après-combat</h2>

<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
    <?php if ($vainqueur) : ?>
        <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-green-500">
            <h2 class="text-2xl font-bold text-green-400 mb-3"><?= htmlspecialchars($vainqueur["nom"]) ?></h2>
            <p>❤️ Santé : <span class="font-semibold"><?= $vainqueur["sante"] ?></span></p>
            <p>💪 Force : <span class="font-semibold"><?= $vainqueur["force"] ?></span></p>
            <p>📈 Niveau : <span class="font-semibold"><?= $vainqueur["niveau"] ?></span><span class="text-green-400"> +<?= $gainNiveau; ?></span></p>
        </div>
    <?php endif; ?>

    <?php if ($perdant) : ?>
        <div class="bg-gray-800 rounded-xl shadow-xl p-6 border border-red-500">
            <h2 class="text-2xl font-bold text-red-400 mb-3"><?= htmlspecialchars($perdant["nom"]) ?></h2>
            <p>❤️ Santé : <span class="font-semibold text-red-300"><?= $perdant["sante"] ?></span></p>
            <p>💪 Force : <span class="font-semibold text-red-300"><?= $perdant["force"] ?></span></p>
            <p>📈 Niveau : <span class="font-semibold text-red-300"><?= $perdant["niveau"] ?></span></p>
        </div>
    <?php endif; ?>
</div>

<div class="text-center">
    <a href="/" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-full shadow-lg hover:shadow-blue-500/40 transition">
        <i class="ri-arrow-left-line"></i> Retour à la liste des combattants
    </a>
    <a href="/random-combat" class="inline-flex items-center gap-2 px-6 py-3 bg-green-700 hover:bg-green-800 text-white rounded-full shadow-lg hover:shadow-green-500/40 transition ms-4">
        <i class="ri-loop-right-line"></i> Refaire un combat aléatoire
    </a>
</div>

</body>
</html>
