<!DOCTYPE html>
<html>
<head>
    <title>filtre</title>
    <link rel="stylesheet" href="stylefiltre.css">
</head>
<body>

<?php

require_once('../commun/ArticleManager.php');
require_once('../commun/connexionBD.php');
require_once('../affichage/displayArticleGrid.php');

$connexion = new ConnexionBD();

$articleManager = new ArticleManager($connexion);

$sql="";$params=[];
// Traitement des commandes d'affichage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Nouveautés"])) {
        echo "NOTRE NOUVELLE COLLECTION: !";
        $sql = "SELECT * FROM article WHERE date_ajout >= DATE_SUB(NOW(), INTERVAL 3 MONTH)";
    }
     elseif (isset($_POST["Soldes"])) {
        echo "Articles soldés:";
        $sql = "SELECT * FROM article WHERE reduction != 0";
    } 
    elseif (isset($_POST["Adultes"])) {
        echo "POUR NOS CHERES FEMMES";
        $sql = "SELECT * FROM article WHERE age = :age";
        $params = array(':age' => 'adulte');
    }
    elseif (isset($_POST["Enfants"])) {
        echo "pour les enfants:";
        $sql = "SELECT * FROM article WHERE age = :age";
        $params = array(':age' => 'enfant');
    }
    elseif (isset($_POST["parfums"])) {
        echo "Fragrances de GIRLHOOD";
        $sql = "SELECT * FROM article WHERE category = :category";
        $params = array(':category' => 'parfum');
    }
    elseif (isset($_POST["chaussures"])) {
        echo "Chaussures";
        $sql = "SELECT * FROM article WHERE category = 'category'";
        $params = array(':category' => 'chaussure');
    }elseif ($_POST["action"] == "price_filter") {
        $min = $_POST["min"];
        $max = $_POST["max"];
        // Vérifier si les valeurs de min et max sont valides
        if (is_numeric($min) && is_numeric($max)) {
            echo "Filtrer par prix : ";
           // $sql = "SELECT * FROM article WHERE price BETWEEN $min AND $max";
            $sql = "SELECT * FROM article WHERE price BETWEEN :min AND :max";
            // Ajouter les paramètres à $params
            $params = [':min' => $min, ':max' => $max];
        } else {
            echo '<script>alert("Veuillez entrer des valeurs numériques valides pour le filtre de prix.") </script>';
        }
    }
}

?>

    <form method="post">
        <button type="submit" name="Nouveautés">Nouveautés</button>
        <button type="submit" name="Soldes">Soldes</button>
        <button type="submit" name="Adultes">Adultes</button>
        <button type="submit" name="Enfants">Enfants</button>
        <button type="submit" name="parfums">Nos fragrances</button>
        <button type="submit" name="chaussures">Chaussures</button>

        <form id="form2" method="POST" style="width: 33.33%; float: left; margin: 10px;">
    <fieldset  style="border: 1px solid; border-color: white; padding-right: 70px;display: inline-block;">
        <legend>Price Filter</legend>
        <input type="hidden" name="action" value="price_filter"><br>
        <input type="number" name="min" placeholder = "Min"></input><br>
        <input type="number" name="max" placeholder = "Max"></input><br>
        <button class="button" type = "submit" >OK </button><br>
        </fieldset>
    </form>

    </form>

    

<?php
    if ($sql){
        ?><article>
   <?php $articles = $articleManager->getArticles($sql,$params) ;
    if (!empty($articles )) {
        displayArticleGrid($articles);
    } else {
      echo '<script>alert("Aucun résultat trouvé dans ce filtre") </script>';
    }}
     ?>
     </article>
</body>
</html>
