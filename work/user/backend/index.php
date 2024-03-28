<?php 
require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\configSession.inc.php';
require_once 'includes/signup_view.inc.php';
//require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\signup_contr.inc.php';

?>

<html>
    <head>
        <title>Signup and sign in </title>
    </head>

    <body>
        <form action='C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\signup2.inc.php' method='post'>
            <h1>Sign Up</h1>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="Enter Username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Enter Password"><br>
            <label for="confirmPassword">Confirm Password:</label><br>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" placeholder="UserE-mail@mail.com"><br>
            <label for="phone">Phone Number:</label><br>
            <input type="number" id="phone" name="phone" placeholder="+216 ** *** ***"><br>
            <input type="submit" value="Sign Up">
        </form>

        <?php
        check_signup_errors();
        ?>
    </body>

</html>


