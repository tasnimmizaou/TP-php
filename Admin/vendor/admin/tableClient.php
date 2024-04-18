
<?php  include('header.php');
include ("navbar.php") ;?>


<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <?php include 'nav.php' ?>

        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Clients</h1>
            <?php
            require_once 'commun/autoloader.php';
            $pdo = ConnexionBD::getInstance();
            $req = $pdo->prepare("SELECT * FROM user");
            $req->execute();
            ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Address</th>
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
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                        <a href="modifierClient.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modifier</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger deleteButton" data-id="<?php echo $row['id']; ?>" data-table="user">Supprimer</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <a class="btn btn-primary"  href="ajouterClient.php" >Ajouter</a>
                    </div>
                </div>
            </div>
            <script src="buttons.js"></script>
        </div>


    </div>


</div>

<?php include("footer.php"); include("scripts.php");?>