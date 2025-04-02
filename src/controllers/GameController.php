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

    public function highestPv()
    {
        $manager = new EntityManager("combattant");
        $combattantByPv = $manager->findByHighestSpeciality("sante");
        $this->renderPhpView("home.php", ["combattant" => $combattantByPv]);
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
        $gainSante = rand(1, 5);
        $gainForce = rand(1, 10);

        if ($c1["sante"] <= 0 && $c2["sante"] <= 0) {
            $vainqueur = "Match nul";
        } else if ($c1["sante"] <= 0) {
            $manager = new EntityManager("combattant");
            $vainqueur = $c2;
            $perdant = $c1;

            $vainqueur["niveau"] += $gainNiveau;
            $vainqueur["sante"] += $gainSante;
            $vainqueur["force"] += $gainForce;

            $endCombat = "Combat terminé! " . $perdant["nom"] . " est KO!";

            $manager->update($vainqueur["Id"], [
                "niveau" => $vainqueur["niveau"],
                "force" => $vainqueur["force"],
                "sante" => $vainqueur["sante"]
            ]);
        } else {
            $manager = new EntityManager("combattant");
            $vainqueur = $c1;
            $perdant = $c2;

            $endCombat = "Combat terminé! " . $perdant["nom"] . " est KO!";

            $vainqueur["niveau"] += $gainNiveau;
            $vainqueur["sante"] += $gainSante;
            $vainqueur["force"] += $gainForce;

            $manager->update($vainqueur["Id"], [
                "niveau" => $vainqueur["niveau"],
                "force" => $vainqueur["force"],
                "sante" => $vainqueur["sante"]
            ]);
        }

        $this->renderPhpView("random-combat.php",
            [
                "c1" => $c1,
                "c2" => $c2,
                "commentaries" => $commentaries,
                "vainqueur" => $vainqueur,
                "gainNiveau" => $gainNiveau,
                "gainSante" => $gainSante,
                "gainForce" => $gainForce,
                "perdant" => $perdant,
                "endCombat" => $endCombat
            ]);
    }
}