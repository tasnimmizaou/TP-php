<?php
require_once "commun/autoload.php";
session_start();

if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname)) {
        header("Location: indexAdmin.php?error=Username is required");
        exit();
    } elseif (empty($pass)) { 
        header("Location: indexAdmin.php?error=Password is required");
        exit();
    } else {
        $pdo = ConnexionBD::getInstance();

        $sql = "SELECT * FROM admins WHERE username=? AND userpassword=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uname, $pass]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user) {
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['id'] = $user['id'];
            header("Location:indexDashboard.php");
            exit();
        } else {
            header("Location: indexAdmin.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: indexAdmin.php");
    exit();
}
?>
