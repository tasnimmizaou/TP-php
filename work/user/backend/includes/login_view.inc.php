<?php
declare (strict_types=1);
function check_login_error() {
    if(isset($_SESSION["errors_login"])) {
        $errors =$_SESSION["errors_login"];

        echo "<br>";
        foreach ($errors as $error)
        {  echo $error. "<br>";    }
        
        unset($_SESSION["errors_login"]);
        
        
    } else if (isset($_GET["login"]) && ($_GET["login"] ==="success")) 
    {
        echo "LOGED IN SUCCESSFULLY "."<br>";
        echo"<html> 
          <head></head>
          <body>
           <a href='index.php' style='color: green;'>HOME PAGE</a>
          </body>
        
            </html> ";

        
    }
}

function output_username()
{
    if (isset($_SESSION["user_id"])){
        echo "<p style='color: green; font-size: 16px; text-align: center;'>You are logged in as ".$_SESSION["user_username"]."</p>";

    }
    else {
        echo "<p style='color: red; font-size: 16px; text-align: center;'>You are not logged in. You can login now.</p>";

    }

}


