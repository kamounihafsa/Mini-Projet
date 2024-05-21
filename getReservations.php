<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Matches Réservés</title>
    <style>
       
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px; 
            border: 1px solid white;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            background-color: white; 
        }

        th {
            background-color: green;
        }

        body {
            background-image: url("WhatsApp Image 2024-05-20 à 20.03.27_348f08b9.jpg"); 
            color: black; 
        }
    </style>
</head>
<body>
    <h2>Liste des Matches Réservés</h2>

    <?php
    
    require_once 'db.php';

    
    $sql = "SELECT m.team_home, m.team_away, m.date, m.venue, r.quantity 
            FROM reservations r 
            INNER JOIN matches m ON r.match_id = m.id";

   
    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Équipe à domicile</th><th>Équipe à l'extérieur</th><th>Date</th><th>Lieu</th><th>Quantité</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["team_home"] . "</td>";
            echo "<td>" . $row["team_away"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["venue"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>"; 
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun match réservé trouvé.";
    }

   
    $connexion->close();
    ?>

</body>
</html>
