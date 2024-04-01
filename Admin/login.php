<?php
include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data=trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    $uname=validate($_POST['uname']);
    $pass=validate($_POST['password']);
    if(empty($uname)){
        header("Location: index.php?error=Username is required");
        exit();
    }else if (empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM admins WHERE username=? AND userpassword=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user){
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['id'] = $user['id'];
            header("Location: table_dashboard.php");
            exit();
        }else{
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }

}else{
    header("Location: index.php");
    exit();
}
