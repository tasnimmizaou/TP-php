
<?php  include('header.php');
 include ("navbar.php") ;
 ?>


<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <?php include 'nav.php' ?>

        <div class="container-fluid">
            <?php
            require_once 'commun/autoloader.php';
            $pdo = ConnexionBD::getInstance();
            $req = $pdo->prepare("SELECT * FROM admins");
            $req->execute();
            ?>
            <div class="container">
                <h2 class="mt-3 mb-4">Admins</h2>
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
                                    </td>
                                    <td>
                                        <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>" data-table="admins">Supprimer</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <a class="btn btn-primary"  href="ajouterAdmin.php" >Ajouter</a>
                    </div>
                </div>
            </div>
            <script src="buttons.js"></script>
        </div>


    </div>


</div>
<?php include("footer.php"); include("scripts.php");?>
