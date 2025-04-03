document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");
    const logsZone = document.querySelector(".fight-logs");
    const playerTurn = document.querySelector(".turn");

    const koScreen = document.createElement("div");
    koScreen.className = "fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 text-8xl font-extrabold text-red-600";
    koScreen.style.display = "none";
    document.body.appendChild(koScreen);

    const randomStart = Math.random() < 0.5 ? "1" : "2";
    const startingForm = document.getElementById(randomStart);
    let currentTurnId = startingForm.querySelector(".attaquant").value;

    forms.forEach(form => {
        const attaquantId = form.querySelector(".attaquant").value;
        const boutons = form.querySelectorAll("button");

        if (attaquantId !== currentTurnId) {
            boutons.forEach(btn => btn.disabled = true);
            form.style.opacity = "0.5";
        } else {
            playerTurn.innerHTML = "Au joueur " + randomStart + " de jouer";
            boutons.forEach(btn => btn.disabled = false);
            form.style.opacity = "1";
        }
    });

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const boutons = form.querySelectorAll("button");
            boutons.forEach(btn => btn.disabled = true);

            const damage = e.submitter.querySelector(".damage");
            const damageValue = damage.value;
            const attaquantId = form.querySelector(".attaquant").value;
            const opponentId = form.querySelector(".opponent").value;
            const attaqueName = e.submitter.value;

            const opponentForm = Array.from(forms).find(f =>
                f.querySelector(".attaquant").value === opponentId
            );

            let newHealth = "";
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

                    if (response.message === "no combat") {
                        alert("Aucun combat trouvé.");
                        window.location.href = "/";
                        return;
                    }

                    if (response.message === "Game Over!") {
                        koScreen.style.display = "flex";
                        koScreen.innerHTML = response.data["nom"] + " gagne le combat !";
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2500);
                        return;
                    }

                    if (!response.success) {
                        console.error("Erreur d'action:", response);
                        return;
                    }

                    if (currentTurnId === response.opponentId) {
                        currentTurnId = response.attaquantId;
                    } else {
                        currentTurnId = response.opponentId;
                    }

                    forms.forEach(form => {
                        const attaquantId = form.querySelector(".attaquant").value;
                        const boutons = form.querySelectorAll("button");

                        if (attaquantId !== currentTurnId) {
                            playerTurn.innerHTML = "Au joueur 1 de jouer";
                            boutons.forEach(btn => btn.disabled = true);
                            form.style.opacity = "0.5";
                        } else {
                            playerTurn.innerHTML = "Au joueur 2 de jouer";
                            boutons.forEach(btn => btn.disabled = false);
                            form.style.opacity = "1";
                        }
                    });

                    if (response.commentaires) {
                        const p = document.createElement("p");
                        p.className = "bg-yellow-100/10 border-l-4 border-yellow-400 px-4 py-2 rounded text-yellow-300 shadow-md text-xl animate-fadeIn";
                        p.textContent = response.commentaires[0];
                        logsZone.appendChild(p);
                        logsZone.scrollTop = logsZone.scrollHeight;
                    }

                    if (response.opponentId === opponentId) {
                        const opponentHealthInput = opponentForm.querySelector(".sante");
                        if (opponentHealthInput) {
                            opponentHealthInput.value = newHealth;
                            const healthValueDisplay = opponentForm.querySelector(".health-value");
                            const healthBar = opponentForm.querySelector(".health-bar");
                            if (healthBar && healthValueDisplay) {
                                healthValueDisplay.textContent = newHealth;
                                healthBar.style.width = newHealth + "%";
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
                attaqueId: attaqueName,
                opponentHealth: newHealth
            }));
        });
    });
});
