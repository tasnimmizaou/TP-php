
<?php  include('header.php');
include ("navbar.php") ;
?>


<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <?php include 'nav.php' ?>

        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Articles</h1>

            <?php
            require_once 'commun/autoload.php';
            $pdo = ConnexionBD::getInstance();
            $req = $pdo->prepare("SELECT * FROM article");
            $req->execute();
            ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>reduction</th>
                                <th>date_ajout</th>
                                <th>Catégorie</th>
                                <th>age</th>
                                <th>Quantité</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['reduction']; ?></td>
                                    <td><?php echo $row['date_ajout']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['age']; ?></td>
                                    <td><?php echo $row['stock']; ?></td>
                                    <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" width="100px" height="100px" alt="Image">' ?></td>
                                    <td>
                                        <a href="modifier_article.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>" data-table="article">Supprimer</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <a class="btn btn-primary"  href="ajouter_article.php" >Ajouter</a>
                    </div>
                </div>
            </div>
            <script src="buttons.js"></script>
        </div>


    </div>


</div>
<?php include("footer.php"); include("scripts.php");?>
