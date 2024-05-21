
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour charger les matchs disponibles
    function loadMatches() {
        // Effectuer une requête AJAX pour récupérer les matchs disponibles depuis le backend
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'getMatches.php', true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Mettre à jour le contenu de la page avec les matchs récupérés
                document.getElementById('matches-container').innerHTML = xhr.responseText;
            } else {
                console.error('Erreur lors du chargement des matchs : ' + xhr.statusText);
            }
        };
        xhr.send();
    }

    // Charger les matchs au chargement initial de la page
    loadMatches();

    // Fonction pour gérer la soumission du formulaire de réservation
    document.getElementById('reservation-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer les données du formulaire
        var formData = new FormData(this);

        // Effectuer une requête AJAX pour soumettre les données de réservation au backend
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'reserveTicket.php', true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Afficher un message de succès
                alert('Réservation effectuée avec succès !');

                // Recharger les matchs pour afficher les mises à jour
                loadMatches();
            } else {
                console.error('Erreur lors de la réservation : ' + xhr.statusText);
            }
        };
        xhr.send(formData);
    });
});