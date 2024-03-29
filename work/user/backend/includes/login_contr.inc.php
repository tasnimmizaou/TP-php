<?php
 declare (strict_types=1);

 function is_email_invalid( string $email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        return true ;
     }else {
        return false ;
     }
    }
 
 function email_in_database(bool|array $result)
 {if ($result = false)
    return false;
    else 
    return true;

    
 }

 function is_password_wrong(string $password, string $hashedpassword)
 {
     if (password_verify($password, $hashedpassword))
    return false;
    else 
    return true;
 }

 function is_input_empty($email,$password){
    if(empty($email)||empty($password))
     return true ;
    else 
     return false ;



 }