<?php
if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $email = $_POST["email"];
    $password = $_POST["password"];

 try {
    require_once "dbhc.inc.php";
    require_once "login_model.inc.php";
    //require_once  "login_view.inc.php";
    require_once "login_contr.inc.php";



    // Error Handling:
    $errors = [];
    if (is_input_empty($email,$password)) {
      $errors["empty_input"] = "Please enter all fields !!";
    }

    if (is_email_invalid($email)) {
      $errors["invalid_email"] = "Please enter a valid email!!";
    }

    $result= get_email($pdo,$email);

    if ( email_in_database($result))
      {
        $errors["incorrect_email"] ="Please enter a valid email";
      }

    if (is_password_wrong($password,  $result["password"])&&(!is_email_invalid($email)))  
    {
        $errors ["password_wrong"] = "Incorrect Passwords";
    }

   

    require_once 'configSession.inc.php';
    if ($errors) {
      $_SESSION["errors_login"] = $errors;
      header("Location:../login.php");
      die();
    }

    if($errors)
    {
        $_SESSION["errors_login"] = $errors;
        header("Location:../login.php");
        die();
    }

    header("Location:../login.php ? login=success");
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

