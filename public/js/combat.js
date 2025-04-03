document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    // ✅ Écran "K.O."
    const koScreen = document.createElement("div");
    koScreen.className = "fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 text-8xl font-extrabold text-red-600";
    koScreen.style.display = "none";
    koScreen.innerText = "K.O.";
    document.body.appendChild(koScreen);

    // ✅ Compte à rebours
    const countdownOverlay = document.createElement("div");
    countdownOverlay.className = "fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 text-7xl font-bold text-white";
    document.body.appendChild(countdownOverlay);

    const countdown = ["3", "2", "1", "FIGHT!"];
    let index = 0;

    const showCountdown = () => {
        countdownOverlay.innerText = countdown[index];
        if (index < countdown.length - 1) {
            index++;
            setTimeout(showCountdown, 1000);
        } else {
            setTimeout(() => {
                countdownOverlay.remove();
            }, 1000);
        }
    };

    showCountdown();

    // ✅ Gestion des attaques
    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

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
                        alert("Aucun combat actif trouvé. Redirection vers l'accueil.");
                        window.location.href = "/";
                        return;
                    }

                    if (response.message === "Game Over!") {
                        koScreen.style.display = "flex";
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2500);
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