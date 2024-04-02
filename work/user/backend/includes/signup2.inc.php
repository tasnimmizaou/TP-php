<?php
if($_SERVER["REQUEST_METHOD"] ==='POST'){
   $username = $_POST["username"];
   $password = $_POST["password"];
   $email = $_POST["email"];
   $phone = $_POST["phone"];
   $address=$_POST["address"];
   try {
   
    require_once "dbhc.inc.php";
    require_once "signup_model.inc.php";
    require_once "signup_contr.inc.php";
  
    // Error Handling:
    $errors = [];
    if (is_input_empty($username, $password, $phone, $email,$address)) {
      $errors["empty_input"] = "Please enter all fields !!";
    }

    if (is_email_invalid($email)) {
      $errors["invalid_email"] = "Please enter a valid email!!";
    }

    if (is_username_used($pdo , $username)) {
      $errors["used_username"] = "This username is already taken !!";
    }

    if (is_email_registered($pdo, $email)) {
      $errors["used_email"] = "This E-mail is already used !!";
    }

    require_once 'configSession.inc.php';
   /* if ($errors) {
      $_SESSION["errors_signup"] = $errors;
     
    }
    header("location:signup.php");
    die();*/

    if($errors)
    {
        $_SESSION['signup_errors'] = $errors;
        $signupData=[
                  "username"=>$username,
                  "email"=>$email,
                  "phone"=>$phone ];
         $_SESSION['signup_data']=$signupData;

        header("location:../signup.php");
        die();
    }


   //add the user in the data base :
    create_user($pdo, $username, $password, $phone, $email,$address);
    $pdo = null;
    $stmt = null;
    header("location:../signup.php?signup=success");
    die();

    }
      catch (PDOException $e) {
    die("Error: " . $e->getMessage());
  }
} else {
  header("location:.../index.php");
  die();
}
?>
