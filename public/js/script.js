document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const errorText = document.getElementById("errorText");
        const checkboxes = document.querySelectorAll('input[name="combattants[]"]:checked');

        if (checkboxes.length !== 2) {
            errorText.innerHTML = "Veuillez sélectionner seulement deux combattants.";
            return;
        }

        errorText.innerHTML = "";

        const formData = new FormData(form);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/combatCheck", true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                console.log("Réponse du serveur :", response);

                if (response.success) {
                    window.location.href = "/combat";
                }
            } else {
                console.log("Une erreur est survenue");
            }
        };

        xhr.send(formData);
    });
});

/* function ajaxAction() {
    const formData = new FormData();
    fetch('/api/combatCheck', {
        method: 'POST',
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                document.querySelector('#errorText').textContent = 'Erreur dans l\'ajout d'
                throw new Error(`Error: ${response.status} - ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
        })
        .catch(error => {
            document.querySelector('#errorText').textContent = 'Une erreur s\'est produite'
            console.error('Error:', error);
        });
}

document.getElementById('submitBtn').addEventListener('click', (evt) => {
    evt.preventDefault();
    console.log(`click`);
    ajaxAction()
}); */
