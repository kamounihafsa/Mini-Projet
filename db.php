<?php

// Informations de connexion à la base de données
$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$base_de_donnees = "football_tickets"; // nom de la base de données

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Définir le jeu de caractères de la connexion
$connexion->set_charset("utf8");

?>