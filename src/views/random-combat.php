<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Combat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen font-sans py-10">

<h1 class="text-4xl font-bold text-center text-gray-800 mb-10">
    ⚔️ Combat : <span class="text-blue-600"><?= htmlspecialchars($c1["nom"]) ?></span> vs <span
            class="text-red-600"><?= htmlspecialchars($c2["nom"]) ?></span>
</h1>

<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 mb-8">
    <h3 class="text-2xl font-semibold text-gray-700 mb-4">📜 Déroulement du combat</h3>
    <ul class="list-disc pl-5 space-y-2 text-gray-800 max-h-[300px] overflow-y-auto">
        <?php foreach ($commentaries as $entry): ?>
            <li><?= htmlspecialchars($entry); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php if ($endCombat): ?>
        <p class="text-center mt-5 text-indigo-500 text-[24px]"><?= htmlspecialchars($endCombat); ?></p>
    <?php endif ?>
</div>

<div class="text-center mb-6">
    <p class="text-2xl font-bold text-green-600">🏆 Vainqueur : <?= htmlspecialchars($vainqueur["nom"]) ?></p>
</div>

<h2 class="text-center text-[32px] mb-4 text-blue-500">Après-combat : </h2>

<div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    <?php if ($vainqueur) : ?>
        <div class="bg-white rounded-xl shadow-lg p-6 border border-green-500">
            <h2 class="text-xl font-bold text-blue-700 mb-2"><?= htmlspecialchars($vainqueur["nom"]) ?></h2>
            <p>❤️ Santé : <span class="font-semibold"><?= $vainqueur["sante"] ?></span><span
                        class="text-green-500"> +<?= $gainSante; ?></span></p>
            <p>💪 Force : <span class="font-semibold"><?= $vainqueur["force"] ?></span><span
                        class="text-green-500"> +<?= $gainForce; ?></span></p>
            <p>📈 Niveau : <span class="font-semibold"><?= $vainqueur["niveau"] ?></span><span
                        class="text-green-500"> +<?= $gainNiveau; ?></span></p>
        </div>
    <?php endif; ?>

    <?php if ($perdant) : ?>
        <div class="bg-white rounded-xl shadow-lg p-6 border border-red-500">
            <h2 class="text-xl font-bold text-red-700 mb-2"><?= htmlspecialchars($perdant["nom"]) ?></h2>
            <p>❤️ Santé : <span class="font-semibold text-red-500"><?= $perdant["sante"] ?></span></p>
            <p>💪 Force : <span class="font-semibold text-red-500"><?= $perdant["force"] ?></span></p>
            <p>📈 Niveau : <span class="font-semibold text-red-500"><?= $perdant["niveau"] ?></span></p>
        </div>
    <?php endif; ?>
</div>

<div class="text-center">
    <a href="/" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-full shadow hover:bg-blue-700 transition">←
        Retour à la liste des combattants</a>
    <a href="/random-combat"
       class="inline-block ms-4 px-5 py-2 bg-green-600 text-white rounded-full shadow hover:bg-green-700 transition">Refaire
        un combat aléatoire</a>
</div>

</body>
</html>
