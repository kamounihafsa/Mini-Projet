<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Matches Réservés</title>
    <style>
        body {
            background-image: url('ballon.jpg'); /* Remplacez 'background_football.jpg' par le chemin de votre image de fond */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        table {
            border: 2px solid green; /* Bordure de couleur verte */
            border-collapse: collapse;
            width: 80%; /* Largeur du tableau */
            margin: 50px auto; /* Centrer le tableau */
            background-color: white; /* Couleur de fond du tableau */
        }

        th, td {
            border: 1px solid green; /* Bordure des cellules */
            padding: 8px; /* Espacement à l'intérieur des cellules */
            text-align: center; /* Centrer le contenu des cellules */
        }

        th {
            background-color: lightgreen; /* Couleur de fond des en-têtes */
        }
    </style>
</head>
<body>
    <h2>Liste des Matches Réservés</h2>

    <!-- Tableau pour afficher les matches réservés -->
    <table>
        <tr>
            <th>Équipe à domicile</th>
            <th>Équipe à l'extérieur</th>
            <th>Date</th>
            <th>Lieu</th>
        </tr>
        <?php
        // Inclure le fichier de connexion à la base de données
        require_once 'db.php';

        // Requête SQL pour récupérer les matches réservés
        $sql = "SELECT team_home, team_away, date, venue FROM reservations JOIN matches ON reservations.match_id = matches.id";

        // Exécuter la requête
        $resultat = $connexion->query($sql);

        // Afficher les résultats dans le tableau
        if ($resultat->num_rows > 0) {
            while ($row = $resultat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['team_home'] . "</td>";
                echo "<td>" . $row['team_away'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['venue'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun match réservé trouvé.</td></tr>";
        }

        // Fermer la connexion à la base de données
        $connexion->close();
        ?>
    </table>
</body>
</html>
