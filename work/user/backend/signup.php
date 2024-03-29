<?php 
require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\configSession.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'C:\Users\tasni\Desktop\TP-php\work\user\backend\includes\signup_contr.inc.php';

?>

<html>
    <head>
        <title>Signup</title>
    </head>

    <body>
   
    <div style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
   
    <form id="signup-form" action="includes/signup2.inc.php" method="post" onsubmit="return validateForm()">

        <h1 style="text-align: center;">Sign Up</h1>
        <div style="margin-bottom: 15px;">
            <label for="username" style="display: block; font-weight: bold; margin-bottom: 5px;">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px;">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="confirmPassword" style="display: block; font-weight: bold; margin-bottom: 5px;">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="UserE-mail@mail.com" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="phone" style="display: block; font-weight: bold; margin-bottom: 5px;">Phone Number:</label>
            <input type="number" id="phone" name="phone" placeholder="+216 ** *** ***" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
        </div>
        <button type="submit" style="width: 100%; padding: 10px; border: none; border-radius: 5px; background-color: #007bff; color: #fff; font-size: 16px; cursor: pointer;">Sign Up</button>
    </form>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();
            var confirmPassword = document.getElementById("confirmPassword").value.trim();
            var email = document.getElementById("email").value.trim();
            var phone = document.getElementById("phone").value.trim();

            if (username === "" || password === "" || confirmPassword === "" || email === "" || phone === "") {
                alert("Please fill in all fields.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>






</div>


        <?php
        check_signup_errors();
        ?>
    </body>

</html>


