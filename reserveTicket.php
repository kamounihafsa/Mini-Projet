<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Réservation de Billets</title>
    <style>
        /* Styles CSS pour le formulaire */
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Pour empêcher les débordements de contenu */
        }

        #form-container {
            width: 50%;
            float: left;
            background-image:url('WhatsApp Image 2024-05-20 à 20.05.51_4788ed15.jpg');
            padding: 20px;
            box-sizing: border-box;
            height: 100vh;
            overflow-y: scroll; /* Pour ajouter une barre de défilement si le contenu dépasse */
        }

        #image-container {
            width: 50%;
            float: left;
            background-image: url('ticket.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        #form-container h2 {
            text-align: center;
            color: white;
        }

        #form-container form {
            text-align: center;
        }

        #form-container input[type="submit"] {
            background-color: white;
            color: green;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div id="form-container">
        <h2>Formulaire de Réservation de Billets</h2>

        <!-- Formulaire pour sélectionner un match et la quantité -->
        <form action="reserveTicket.php" method="post">
            <label for="matchSelect">Choisissez un match :</label><br><br>
            <select id="matchSelect" name="matchId">
                <?php
                // Inclure le fichier de connexion à la base de données
                require_once 'db.php';

                // Requête SQL pour récupérer les matchs à venir
                $sql = "SELECT id, team_home, team_away, date, venue FROM matches WHERE date > NOW() ORDER BY date ASC";

                // Exécuter la requête
                $resultat = $connexion->query($sql);

                // Afficher les options du menu déroulant
                if ($resultat->num_rows > 0) {
                    while ($row = $resultat->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['team_home'] . ' vs ' . $row['team_away'] . ' - ' . $row['date'] . ' à ' . $row['venue'] . '</option>';
                    }
                } else {
                    echo '<option value="">Aucun match à venir trouvé</option>';
                }

                // Fermer la connexion à la base de données
                $connexion->close();
                ?>
            </select><br><br>
            <label for="quantity">Quantité :</label><br><br>
            <input type="number" id="quantity" name="quantity" min="1" value="1"><br><br>
            <input type="submit" value="Réserver des billets">
        </form>
    </div>
    <div id="image-container"></div>
</body>
</html>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $matchId = $_POST['matchId'];
    $quantity = $_POST['quantity'];
    
    // Récupérer l'ID de l'utilisateur à partir de la session
    session_start();
    $userId = $_SESSION['user_id']; // Assurez-vous d'ajuster la clé de session selon votre implémentation

    // Ajouter votre logique pour enregistrer la réservation dans la table `reservations`
    require_once 'db.php';
    $sql = "INSERT INTO reservations (match_id, user_id, quantity) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("iii", $matchId, $userId, $quantity);
    
    if ($stmt->execute()) {
        // Rediriger l'utilisateur vers la page de réservations avec un message de succès
        header("Location: getReservations.php");
        exit(); // Terminer le script après la redirection
    } else {
        echo "Erreur lors de l'enregistrement de la réservation : " . $connexion->error;
    }
}
?>
