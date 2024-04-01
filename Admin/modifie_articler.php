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
        .editable {
            cursor: pointer;
        }
        .editable:hover {
            background-color: #f2f2f2;
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
                    <label>Nom :</label>
                    <input class="editable form-control" type="text" name="name" id="name" pattern="[A-Za-z0-9\s]+" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Description :</label>
                    <textarea class="form-control" name="description" id="description" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Prix :</label>
                    <input type="number" class="form-control" name="price" id="price" min="0" value="<?php echo $row['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Réduction :</label>
                    <input type="number" class="form-control" name="reduction" id="reduction" min="0" value="<?php echo $row['reduction']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Catégorie :</label>
                    <select class="form-control" name="category" id="category" required>
                        <option <?php if ($row['category'] === 'Sportswear') echo 'selected'; ?>>Sportswear</option>
                        <option <?php if ($row['category'] === 'Fragrances') echo 'selected'; ?>>Fragrances</option>
                        <option <?php if ($row['category'] === 'Accessoires') echo 'selected'; ?>>Accessoires</option>
                        <option <?php if ($row['category'] === 'Vêtements') echo 'selected'; ?>>Vêtements</option>
                        <option <?php if ($row['category'] === 'Chaussures') echo 'selected'; ?>>Chaussures</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Âge :</label>
                    <select class="form-control" name="age" id="age" required>
                        <option <?php if ($row['age'] === 'adulte') echo 'selected'; ?>>adulte</option>
                        <option <?php if ($row['age'] === 'enfant') echo 'selected'; ?>>enfant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantité :</label>
                    <input type="number" class="form-control" name="stock" id="stock" min="0" value="<?php echo $row['stock']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="table_dashboard.php" class="btn btn-secondary">Retour à la page de dashboard</a>
            </form>
            <?php
        } else {
            echo "L'article avec l'ID $article_id n'existe pas.";
        }
    } else {
        echo "ID de l'article non spécifié.";
    }
    ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['reduction'], $_POST['category'], $_POST['age'], $_POST['stock'])) {
        $article_id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $reduction = $_POST['reduction'];
        $category = $_POST['category'];
        $age = $_POST['age'];
        $stock = $_POST['stock'];

        require_once 'autoloader.php';
        $pdo = ConnexionBD::getInstance();
        $req = $pdo->prepare("UPDATE article SET name = ?, description = ?, price = ?, reduction = ?, category = ?, age = ?, stock = ? WHERE id = ?");
        if ($req->execute([$name, $description, $price, $reduction, $category, $age, $stock, $article_id])) {
            echo "<div class='alert alert-success mt-3' role='alert'>Les modifications ont été enregistrées avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' role='alert'>Erreur lors de l'enregistrement des modifications.</div>";
        }
    } else {
        echo "<div class='alert alert-warning mt-3' role='alert'>Veuillez fournir toutes les données nécessaires.</div>";
    }
}
?>

</body>
</html>
