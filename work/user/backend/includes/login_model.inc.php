<?php

function get_email($pdo,$email){
    $query ="SELECT * from users    WHERE email =:email;";
    $stmt= $pdo->prepare($query);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}


