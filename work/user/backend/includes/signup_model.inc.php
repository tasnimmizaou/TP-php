<?php
declare (strict_types=1);

//to interacet with the database: about updating and uploading data and deleting etc 


function get_username(object $pdo ,string $username )
{$query ="SELECT username from users WHERE username =:username;";
    $stmt= $pdo->prepare($query);
    $stmt->bindParam(":username",$username);
    $stmt->execute();

   $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result; 
}

function get_email(object $pdo ,string $email ){
    $query ="SELECT email from users WHERE email =:email;";
    $stmt= $pdo->prepare($query);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo , string $username, string $password,$phone, string $email , string $address)
{ $query ="INSERT into users(username,password,phone,email,address) VALUES(:username,:password,:phone,:email,:address); ";
    $stmt= $pdo->prepare($query);
    
    //$options =['cost'=>12];
    $hashedpassword=password_hash($password,PASSWORD_BCRYPT);

    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":password",$hashedpassword);
    $stmt->bindParam(":phone",$phone);
    $stmt->bindParam(":address",$address);

    $stmt->execute();

    

}