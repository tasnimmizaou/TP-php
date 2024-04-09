<?php include('header.php'); include('navbar.php'); ?>

<div class="container-fluid">
    <h2 class="mt-5 mb-4">Ajouter un article</h2>
    <form action="" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" class="form-control-file" name="image" id="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="tableArticle.php" class="btn btn-secondary">Retour à la page de dashboard</a>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['reduction'], $_POST['category'], $_POST['age'], $_POST['stock'], $_FILES['image'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $reduction = $_POST['reduction'];
        $category = $_POST['category'];
        $age = $_POST['age'];
        $stock = $_POST['stock'];

        $image = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($image);

        require_once 'commun/autoloader.php';
        $pdo = ConnexionBD::getInstance();

        $req = $pdo->prepare("INSERT INTO article (name, description, price, reduction, category, age, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($req->execute([$name, $description, $price, $reduction, $category, $age, $stock, $imageData])) {
            $_SESSION['success']="Article ajouté avec succès";
        } else {
            $_SESSION['status']="Article non ajouté";
        }
    } else {
        $_SESSION['status']="Veuillez fournir toutes les données nécessaires";
    }
}
include("footer.php"); include("scripts.php");?>
