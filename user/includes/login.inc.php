<?php
if($_SERVER["REQUEST_METHOD"] === 'POST'){
    
    $password = $_POST["password"];
    $username = $_POST["username"];

   try {
     require_once "dbhc.inc.php";
      require_once "login_model.inc.php";
      require_once "login_contr.inc.php";



       // Error Handling:
      $errors = [];
      if (is_input_empty($username,$password)){
     $errors["empty_input"] = "Please enter all fields !!";
      }

      $result=get_username( $pdo,  $username);

      if (is_username_wrong($result)){
      $errors["username_wrong"] = "Incorrect login info!!";
       }


       if (!is_username_wrong($result)&& is_password_wrong( $password,  $result["password"]))
       {
           $errors ["password_wrong"] = "Incorrect login info !!";
       }



         require_once 'configSession.inc.php';

       if ($errors) {
       $_SESSION["errors_login"] = $errors;
       header("Location:../test.php");
       die();
      }
      
      //securtiy ID regeneration:
      
       $_SESSION["user_id"]=$result["id"];
       $_SESSION["user_username"]= htmlspecialchars( $result["username"]);
       $_SESSION['last_session_regenerate'] = time();
    
     
     //$url="C:\xampp\htdocs\TP-php\home\home.php";
    // header("Location:../$url?login=success");
     $pdo=null;
     $stmt=null;
     die();


       


    }catch (PDOException $e) {
     die("Error: " . $e->getMessage());
      }

}else {
    header("Location:../login.php");
    die();
}

