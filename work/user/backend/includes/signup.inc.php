<?php
if($_SERVER ["REQUEST_METHOD"] == "POST"){


}else{ 
       $username=$_POST["username"];
       $password=$_POST["password"];
       $email=$_POST["email"];
       $phone=$_POST["phone"];
       $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
       require_once "dbh.inc.php";
     $query="INSERT INTO users( username,password,email,phone) VALUES(:username,:password,:email,::phone);"; 
     $stmt=$pdo->prepare($query);
     $stmt->bindParam(":username",$username);
     $stmt->bindParam(":password",$hashedPassword);
     $stmt->bindParam(":email",$email);
     $stmt->bindParam(":phone",$phone);

     $stmt->execute();
     $pdo=null;
     $stmt=null;
     header("location:../index.php");
     die();

}