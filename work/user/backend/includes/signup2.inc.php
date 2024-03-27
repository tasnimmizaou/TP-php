<?php
if($_SERVER ["REQUEST_METHOD"] === 'POST'){
  try{
       $username=$_POST["username"];
       $password=$_POST["password"];
       $email=$_POST["email"];
       $phone=$_POST["phone"];
       $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       require_once "dbh.inc.php";
       require_once "signup_model.inc.php";
       //require_once  "signup_view.inc.php";
       require_once "signup_cont.inc.php";
      
        //Error Handling:
        $errors=[];
        if ( is_input_empty($username,$password,$phone,$email) ){
          $errors["empty_input"]="Please enter all fields !!";
        }

        if (is_email_invalid($email)){
          $errors["invalid_email"]="Please enter a valid email!!";
        }

        if (is_username_used($pdo ,$username)){
          $errors["used_username"]="This username is already taken !!";
        }

        if (is_email_registered($pdo ,$email))  {
          $errors["used_email"]="This E-mail is already used !!";
        }

        require_once 'configSession.inc.php';
       if ($errors){
          $_SESSION["errors_signup"] =$errors;
          header("location:../index.php");
       } 


     header("location:../index.php");
     die();
    
     }
      catch(PDOException $e)
     {
      die ("Error: " . $e->getMessage());
     }


} else{
  header("location:../index.php");
  die();
}