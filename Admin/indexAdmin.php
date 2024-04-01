<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Login Admin</title>
</head>
<body>
    <form action="login.php" method="post">
        <h2>Login Admin</h2>
        <?php if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error'];?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name">
        <label>User Password</label>
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>

    </form>
</body>
</html>
