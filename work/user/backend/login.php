<?php 
require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\configSession.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\signup_contr.inc.php';

?>
<html>
    <head>
        <title>Login page </title>
    </head>

    <body>
    <div style="max-width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">

<h2 style="text-align: center; margin-bottom: 20px;">Login</h2>

<form id="login-form" action="includes/login.inc.php" method="post" onsubmit="return validateForm()">

    <div style="margin-bottom: 15px;">
        <label for="username" style="display: block; font-weight: bold; margin-bottom: 5px;">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter Username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
    </div>

    <button type="submit" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; font-size: 16px; cursor: pointer;">Login</button>

    <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
</form>

</div>
    </body>
</html>