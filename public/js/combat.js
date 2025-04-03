document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();


            const damage = e.submitter.querySelector(".damage");
            const damageValue = parseInt(damage.value);

            const attaquantId = form.querySelector(".attaquant").value;
            const opponentId = form.querySelector(".opponent").value;
            const attaqueName = e.submitter.value;

            const opponentForm = Array.from(forms).find(f =>
                f.querySelector(".attaquant").value === opponentId
            );

            let newHealth = null;
            if (opponentForm) {
                const opponentHealthInput = opponentForm.querySelector(".sante");
                if (opponentHealthInput) {
                    const currentHealth = opponentHealthInput.value;
                    newHealth = currentHealth - damageValue;
                }
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/startFight", true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response)

                    if (response.message === "no combat") {
                        alert("Aucun combat actif trouvé. Redirection vers l'accueil.");
                        window.location.href = "/";
                        return;
                    }

                    if (response.message === "Game Over!") {
                        alert("Combat terminé! " + response.data["nom"] + " a gagné!")
                        window.location.href = "/";
                        return;
                    }

                    if (!response.success) {
                        return;
                    }

                    if (response.opponentId === opponentId) {
                        const opponentHealthInput = opponentForm.querySelector(".sante");
                        if (opponentHealthInput) {
                            opponentHealthInput.value = newHealth;

                            const healthDisplay = opponentForm.querySelector(".health");
                            if (healthDisplay) {
                                healthDisplay.innerHTML = `<i class="ri-heart-3-fill mr-1 text-red-500"></i>Santé : ${newHealth}`;
                            }
                        }
                    }
                } else {
                    console.log("Une erreur est survenue");
                }
            };

            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.send(JSON.stringify({
                damage: damageValue,
                attaquantId: attaquantId,
                opponentId: opponentId,
                attaque: attaqueName,
                opponentHealth: newHealth
            }));
        });
    });
});
