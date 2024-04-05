<?php
$dsn='mysql:host=localhost;dbname=girlhood';
$dbusername="root";
$dbpassword="";
 
try {
 $pdo = new PDO($dsn, $dbusername, $dbpassword);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur : ". $e->getMessage());
    }

    
    