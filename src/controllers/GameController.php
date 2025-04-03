<?php

namespace App\controllers;

use App\config\EntityManager;

class GameController extends Controller
{
    public function homePage()
    {
        $manager = new EntityManager("combattant");
        $allCombattant = $manager->findAll();
        $this->renderPhpView("home.php", ["combattant" => $allCombattant]);
    }

    public function highestForce()
    {
        $manager = new EntityManager("combattant");
        $combattantByForce = $manager->findByHighestSpeciality("force");
        $this->renderPhpView("home.php", ["combattant" => $combattantByForce]);
    }
    public function highestLevel()
    {
        $manager = new EntityManager("combattant");
        $combattantByLevel = $manager->findByHighestSpeciality("niveau");
        $this->renderPhpView("home.php", ["combattant" => $combattantByLevel]);
    }

    public function randomFight()
    {
        $manager = new EntityManager("combattant");
        $combattants = $manager->findAll();

        shuffle($combattants);
        $c1 = $combattants[0];
        $c2 = $combattants[1];

        $commentaries = [];
        $nb = rand(0, 10);

        if ($nb === 5) {
            while ($c1["sante"] > 0 && $c2["sante"] > 0) {
                $extraForce = rand(10, 20);

                $c1["force"] += $extraForce;
                $c2["force"] += $extraForce;

                $commentaries[] = $c1["nom"] . " attaque " . $c2["nom"] . "! Il lui inflige -" . $c1["force"] . " de dégâts via coup critique!";
                $c2["sante"] -= $c1["force"];

                if ($c2["sante"] <= 0) {
                    break;
                }

                $commentaries[] = $c2["nom"] . " attaque " . $c1["nom"] . "! Il lui inflige -" . $c2["force"] . " de dégâts via coup critique!";
                $c1["sante"] -= $c2["force"];
            }
        } else {
            while ($c1["sante"] > 0 && $c2["sante"] > 0) {
                $commentaries[] = $c1["nom"] . " attaque " . $c2["nom"] . "! Il lui inflige -" . $c1["force"] . " de dégâts";
                $c2["sante"] -= $c1["force"];

                if ($c2["sante"] <= 0) {
                    break;
                }

                $commentaries[] = $c2["nom"] . " attaque " . $c1["nom"] . "! Il lui inflige -" . $c2["force"] . " de dégâts";
                $c1["sante"] -= $c2["force"];
            }
        }

        $gainNiveau = rand(1, 2);

        if ($c1["sante"] <= 0 && $c2["sante"] <= 0) {
            $vainqueur = "Match nul";
        } else if ($c1["sante"] <= 0) {
            $manager = new EntityManager("combattant");
            $vainqueur = $c2;
            $perdant = $c1;

            $vainqueur["niveau"] += $gainNiveau;

            $endCombat = "Combat terminé! " . $perdant["nom"] . " est KO!";
            $manager->update($vainqueur["Id"], [
                "niveau" => $vainqueur["niveau"],
            ]);
        } else {
            $manager = new EntityManager("combattant");
            $vainqueur = $c1;
            $perdant = $c2;

            $endCombat = "Combat terminé! " . $perdant["nom"] . " est KO!";

            $vainqueur["niveau"] += $gainNiveau;

            $manager->update($vainqueur["Id"], [
                "niveau" => $vainqueur["niveau"],
            ]);
        }

        $this->renderPhpView("random-combat.php",
            [
                "c1" => $c1,
                "c2" => $c2,
                "commentaries" => $commentaries,
                "vainqueur" => $vainqueur,
                "gainNiveau" => $gainNiveau,
                "perdant" => $perdant,
                "endCombat" => $endCombat
            ]);
    }

    public function checkFight()
    {
        header('Content-Type: application/json');
        $_SESSION['combattants'] = $_POST['combattants'];

        $combatManager = new EntityManager("combat");

        $combatId = $combatManager->create([
            "id_combattant_1" => $_SESSION['combattants'][0],
            "id_combattant_2" => $_SESSION['combattants'][1],
        ]);

        $_SESSION["combatId"] = $combatId;
        return json_encode(['success' => true]);
    }

    public function startFight()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION["combatId"])) {
            return json_encode(['success' => false, "message" => "no combat"]);
        }

        $combatId = $_SESSION["combatId"];

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $damage = $data['damage'] ?? "not defined";
        $attaquantId = $data['attaquantId'] ?? "not defined";
        $opponentId = $data['opponentId'] ?? "not defined";
        $attaque = $data['attaque'] ?? "not defined";
        $opponentHealth = $data["opponentHealth"] ?? "not defined";

        $userManager = new entityManager("combattant");
        $aptitudeManager = new entityManager("aptitude");

        $winner = $userManager->findById($attaquantId);
        $loser = $userManager->findById($opponentId);
        $attaqueNom = $aptitudeManager->findById($attaque);

        $commentaries = [];
        $commentaries[] = $winner["nom"] . " attaque " . $loser["nom"] . " via " . $attaqueNom["nom"] . "!";

        if ($opponentHealth <= 0) {
            $resultManager = new EntityManager("resultat");
            $resultManager->create([
                "id_combat" => $combatId,
                "gagnant" => $attaquantId
            ]);
            session_destroy();
            return json_encode(['message' => 'Game Over!', "data" => $winner]);
        }

        $roundManager = new EntityManager("round");
        $roundManager->create([
            "id_combat" => $combatId,
            "id_aptitude" => $attaque,
            "id_combattant" => $attaquantId
        ]);

        return json_encode([
            'success' => true,
            'damage' => $damage,
            'attaquantId' => $attaquantId,
            'opponentId' => $opponentId,
            'attaque' => $attaque,
            'opponentHealth' => $opponentHealth,
            "commentaires" => $commentaries,
        ]);
    }

    public function fight()
    {
        $manager = new EntityManager("combattant");

        if (empty($_SESSION)) {
            header("location: /");
            exit();
        }

        $combattant1 = $manager->joinCombattantAptitude($_SESSION['combattants'][0]);
        $combattant2 = $manager->joinCombattantAptitude($_SESSION['combattants'][1]);

        $this->renderPhpView("combat.php", ["combattant1" => $combattant1, "combattant2" => $combattant2]);
    }
}