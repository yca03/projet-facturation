$(document).ready(function () {

    $('#user_nom, #user_prenom').on('input', function () {
        const firstName = $('#user_prenom').val().toLowerCase().trim();
        const lastName = $('#user_nom').val().toLowerCase().trim();

        let prefix = '';
        if (lastName) {
            prefix = lastName.split(' ')[0];
        }
        if (firstName) {
            // Prendre les deux premières lettres du prénom et les mettre en majuscules
            const firstNamePrefix = firstName.substring(0, 2).toUpperCase();
            prefix += (prefix ? '' : '') + firstNamePrefix;
        }

        // Générer une chaîne aléatoire de 4 chiffres
        let length = 4;
        let charset = "0123456789";
        let randomString = "";
        for (let i = 0; i < length; i++) {
            randomString += charset.charAt(Math.floor(Math.random() * charset.length));
        }

        // Construire le nom d'utilisateur final
        const username = `${prefix}_${randomString}`;

        // Afficher le résultat dans le champ Nom d'utilisateur
        $('#user_nomUtilisateur').val(username);
    });
});
