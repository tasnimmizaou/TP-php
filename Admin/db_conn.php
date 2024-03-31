<?php
$sname="localhost";
$uname="root";
$password="";
$dbname="girlhood";
try {
    $conn = new PDO('mysql:host=localhost;dbname=girlhood', $uname, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }catch (PDOException $e) {
        die("Erreur : ". $e->getMessage());
    }