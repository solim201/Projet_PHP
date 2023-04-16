<?php

// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotheque";

try {
    // Création de la connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options de la connexion PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch(PDOException $e) {
    // Gestion des erreurs de connexion
    echo "Erreur de connexion : " . $e->getMessage();
}

