<?php 
require_once 'configSession.inc.php';
?>

<html>
    <head>
        <title>Signup Page</title>
    </head>

    <body>
        <form action="/backend/includes/signup.inc.php" method="post">
            <h1>Sign Up</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="UserE-mail@mail.com">
            <label for="phone">Phone Number:</label>
            <input type="number" id="phone" name="phone" placeholder="+216 ** *** ***">
            <input type="submit" value="Sign Up">
        </form>
    </body>

</html>