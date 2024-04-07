<?php

//declare (strict_types=1);

function check_signup_errors(){
    if(isset($_SESSION['signup_errors'])) {
        $errors = $_SESSION['signup_errors'];

        echo "<br>";
        foreach ($errors as $error)
        {  echo $error . "<br>";    }
        
        unset($_SESSION['signup_errors']);
        
        
    } else if (isset($_GET["signup"]) && ($_GET["signup"] ==="success")) 
    {
        echo "<script> 
        // Show alert
        alert('SIGNED UP  SUCCESSFULLY');
        //Wait for 3 seconds (3000 milliseconds)
        setTimeout(function() {
            // Hide alert
            window.alert = function() {};
        }, 3000);
    </script>";
    }
}