<?php 
require_once 'includes/configSession.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/signup_contr.inc.php';
require_once 'includes/login_model.inc.php';

?>

<html>
<head>
    <title>Signup</title>
    <style>
        body {
            background-color: #ffe6f2;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ffb3d9;
            border-radius: 5px;
            background-color: #fff2f9;
        }
        h1 {
            text-align: center;
            color: #ff80bf;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #ff80bf;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ffb3d9;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff80bf;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff66a3;
        }
        p {
            color: #ff80bf;
        }
    </style>
</head>
<body>

<div class="container">

    <form id="signup-form" action="includes/signup2.inc.php" method="POST" onsubmit="return validateForm()">

        <h1>Sign Up</h1>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password">
        </div>

        <div>
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="UserE-mail@mail.com">
        </div>

        <div>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="+216 ** *** ***">
        </div>

        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter address">
        </div>

        <button type="submit">Sign Up</button>

        <p>Done with signing up? <a href="login.php">Login here</a>.</p>
    </form>

    <?php
    check_signup_errors();
    ?>

</div>

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

</body>
</html>


