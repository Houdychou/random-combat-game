document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const errorText = document.getElementById("errorText");
        const checkboxes = document.querySelectorAll('input[name="combattants[]"]:checked');

        if (checkboxes.length === 0) {
            errorText.innerHTML = "Veuillez sélectionner 2 combattants";
            return;
        }

        if (checkboxes.length !== 2) {
            errorText.innerHTML = "Vous ne pouvez sélectionner que 2 combattants";
            return;
        }

        errorText.innerHTML = "";
        const formData = new FormData(form);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/combatCheck", true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
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
