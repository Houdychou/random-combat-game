document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const damage = e.submitter.querySelector(".damage");
            const damageValue = damage ? damage.value : 0;

            const attaquantId = form.querySelector(".attaquant").value;
            const opponentId = form.querySelector(".opponent").value;
            const attaqueName = e.submitter.value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/startFight", true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (!response.success) return;

                    console.log(response);

                    if (response.opponentId === opponentId) {
                        const opponentForm = Array.from(forms).find(f =>
                            f.querySelector(".attaquant").value === opponentId
                        );
                        if (!opponentForm) {
                            return;
                        }

                        const opponentHealthInput = opponentForm.querySelector(".sante");
                        if (!opponentHealthInput) {
                            return;
                        }

                        const currentHealth = parseInt(opponentHealthInput.value.trim(), 10);
                        const newHealth = currentHealth - response.damage;

                        opponentHealthInput.value = newHealth;

                        const healthDisplay = opponentForm.querySelector(".health");
                        if (healthDisplay) {
                            healthDisplay.innerHTML = `<i class="ri-heart-3-fill mr-1 text-red-500"></i>Santé : ${newHealth}`;
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
                attaque: attaqueName
            }));
        });
    });
});
