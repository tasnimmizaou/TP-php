<?php
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$dbname = "nom_base_de_donnees";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer la valeur de l'input du formulaire
$search = $_POST['search'];

// Requête SQL pour rechercher dans la base de données
$sql = "SELECT * FROM table WHERE champ LIKE '%$search%'"; // Remplacez 'table' par le nom de votre table et 'champ' par le nom du champ à rechercher!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$result = $conn->query($sql);

// Affichage des résultats de la recherche
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Champ: " . $row["champ"]. "<br>";
    }
} else {
    echo "Aucun résultat trouvé";
}

$conn->close();
?>
