
<?php  include('header.php')?>
<?php include ("navbar.php") ?>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php include('logout model.php');?>


<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <?php include 'nav.php' ?>

        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Articles</h1>
            <?php
            require_once 'autoloader.php';
            $pdo = ConnexionBD::getInstance();
            $req = $pdo->prepare("SELECT * FROM admins");
            $req->execute();
            ?>
            <div class="container">
                <h2 class="mt-3 mb-4">Tableau de bord d'administration</h2>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Userpassword</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['userpassword']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                        <a href="modifierAdmin.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                                        <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button class="btn btn-primary mr-2 edit addButton" >Ajouter</button>
                    </div>
                </div>
            </div>
            <script src="buttonsAdmin.js"></script>
        </div>


    </div>


</div>


</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


</body>
<?php include("footer.php"); include("scripts.php");?>
</html>
