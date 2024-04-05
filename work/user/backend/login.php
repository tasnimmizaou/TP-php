<?php 
require_once 'includes/configSession.inc.php';
require_once 'includes/login_view.inc.php';

?>
<html>
<head>
    <title>Login page</title>
</head>
<body style="background-color: #ffe6f2; font-family: 'Arial', sans-serif;">

    <p><?php output_username(); ?></p>

    <div style="max-width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ffb3d9; border-radius: 5px; background-color: #fff2f9;">

        <h2 style="text-align: center; margin-bottom: 20px; color: #ff80bf;">Login</h2>

        <form id="login-form" action="includes/login.inc.php" method="post" onsubmit="return validateForm()">

            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; font-weight: bold; margin-bottom: 5px; color: #ff80bf;">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" style="width: 100%; padding: 10px; border: 1px solid #ffb3d9; border-radius: 5px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px; color: #ff80bf;">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" style="width: 100%; padding: 10px; border: 1px solid #ffb3d9; border-radius: 5px; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background-color: #ff80bf; color: #fff; font-size: 16px; cursor: pointer;">Login</button>

            <p style="color: #ff80bf;">Don't have an account? <a href="signup.php" style="color: #ff80bf;">Sign up here</a>.</p>
        </form>

        <?php check_login_error(); ?>

    </div>

    <div style="text-align: center; margin-top: 20px;">
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit" style="width: 10%; padding: 10px; border: none; border-radius: 5px; background-color: #ff80bf; color: #fff; font-size: 16px; cursor: pointer;">Logout</button>
        </form>
    </div>

</body>
</html>
