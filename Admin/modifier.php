<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $article_id = $_GET['id'];
        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("SELECT * FROM article WHERE id = ?");
        $req->execute([$article_id]);
        if ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <h2 class="mt-5 mb-4">Modifier l'article</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="champ">Champ à modifier :</label>
                    <select class="form-control" name="champ" id="champ">
                        <option value="name">Nom</option>
                        <option value="description">Description</option>
                        <option value="reduction">Réduction</option>
                        <option value="price">Prix</option>
                        <option value="category">Catégorie</option>
                        <option value="age">Âge</option>
                        <option value="stock">Stock</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nouvelle_valeur">Nouvelle valeur :</label>
                    <?php if ($_POST['champ'] == 'name' || $_POST['champ'] == 'description'): ?>
                        <input type="text" class="form-control" name="nouvelle_valeur" id="nouvelle_valeur" required>
                    <?php elseif ($_POST['champ'] == 'reduction' || $_POST['champ'] == 'price' || $_POST['champ'] == 'stock'): ?>
                        <input type="number" class="form-control" name="nouvelle_valeur" id="nouvelle_valeur" min="0" required>
                    <?php elseif ($_POST['champ'] == 'category'): ?>
                        <select class="form-control" name="nouvelle_valeur" id="nouvelle_valeur">
                            <option value="Sportswear">Sportswear</option>
                            <option value="Fragrances">Fragrances</option>
                            <option value="Accessoires">Accessoires</option>
                            <option value="Vetements">Vêtements</option>
                            <option value="Chaussures">Chaussures</option>
                        </select>
                    <?php elseif ($_POST['champ'] == 'age'): ?>
                        <select class="form-control" name="nouvelle_valeur" id="nouvelle_valeur">
                            <option value="adulte">Adulte</option>
                            <option value="enfant">Enfant</option>
                        </select>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="options.php" class="btn btn-secondary">Retour à la page de dashboard</a>
            </form>
            <?php
        } else {
            echo "L'article avec l'ID $article_id n'existe pas.";
        }
    } else {
        echo "ID de l'article non spécifié.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id'], $_POST['champ'], $_POST['nouvelle_valeur']) && !empty($_POST['id']) && !empty($_POST['champ']) && !empty($_POST['nouvelle_valeur'])) {
            $article_id = $_POST['id'];
            $champ = $_POST['champ'];
            $nouvelle_valeur = $_POST['nouvelle_valeur'];

            require_once 'autoloader.php';
            $pdo = ConnexionBD::getInstance();
            $req = $pdo->prepare("UPDATE article SET $champ = ? WHERE id = ?");
            if ($req->execute([$nouvelle_valeur, $article_id])) {
                echo "<div class='alert alert-success mt-3' role='alert'>Succès</div>";
            } else {
                echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de la modification de l'article.</div>";
            }
        } else {
            echo "<div class='alert alert-warning mt-3' role='alert'>Veuillez fournir toutes les données nécessaires.</div>";
        }
    }
    ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
