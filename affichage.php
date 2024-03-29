<!DOCTYPE html><html> <link rel="stylesheet" href="styleaffic.css">
<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "article");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Requête SQL pour sélectionner les articles avec leurs images
$sql = "SELECT * FROM article";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    echo '<table class = "container" > ' ; // Début du tableau
    $articleCount = 0; // Counter to track the number of articles displayed per line
    echo "<tr>"; // Début de la ligne
    while ($article = $result->fetch_assoc()) {

        // Prepare the query to get the image for the current article
        $sql = "SELECT image FROM article WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind the article ID to the query
        $articleId = $article['id']; // Ensure $articleId is defined and an integer
        $stmt->bind_param("i", $articleId);

        // Execute the query
        $stmt->execute();

        // Get the image data
        $resultImage = $stmt->get_result();
        $imageBlob = $resultImage->fetch_assoc()['image'];

        // Encode the image in base64
        $imageData = base64_encode($imageBlob);

        // Close the result and statement
        $resultImage->close();
        $stmt->close();

        // Afficher les informations de l'article dans une cellule de tableau
        echo '<td class = "column">';
        echo "<div class='article'>";
        echo "<h2>" . $article['name'] . "</h2>";
        echo "<img src='data:image/png;base64," . $imageData . "' alt='" . $article['name'] . "' />";
        echo "<p>Prix : " . $article['price'] . " dt</p>";
        echo "<a href='details.php?id=" . $article['id'] . "'>Voir les détails</a>";
        echo "</div>";
        echo "</td>";

        $articleCount++;
        // Si 3 articles ont été affichés, fermez la ligne actuelle et commencez une nouvelle ligne
        if ($articleCount % 3 === 0) {
            echo "</tr><tr>"; // Fermer la ligne actuelle et commencer une nouvelle ligne
        }
    }
    echo "</tr>"; // Fermer la dernière ligne
    echo "</table>"; // Fermer le tableau
    // Fermer le résultat
    $conn->close();
}
?>
</html> 