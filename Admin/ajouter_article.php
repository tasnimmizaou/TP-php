<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration - Ajouter un article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5 mb-4">Ajouter un article</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name" id="name" pattern="[A-Za-z0-9\s]+"
                   title="Le nom ne doit contenir que des lettres, des chiffres ou des espaces." required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" class="form-control" name="price" id="price" min="0" required>
        </div>
        <div class="form-group">
            <label for="reduction">Réduction :</label>
            <input type="number" class="form-control" name="reduction" id="reduction" min="0" required>
        </div>
        <div class="form-group">
            <label for="category">Catégorie :</label>
            <select class="form-control" name="category" id="category">
                <option>Sportswear</option>
                <option>Fragrances</option>
                <option>Accessoires</option>
                <option>Vêtements</option>
                <option>Chaussures</option>
            </select>
        </div>
        <div class="form-group">
            <label for="age">Âge :</label>
            <select class="form-control" name="age" id="age">
                <option>adulte</option>
                <option>enfant</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stock">Quantité :</label>
            <input type="number" class="form-control" name="stock" id="stock" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="options.php" class="btn btn-secondary">Retour à la page de dashboard</a>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
