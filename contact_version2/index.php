<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Contact Us</title>
</head>
<body>

    <div class="container">
         <h1 > Contact Us </h1>
             <hr>
                <?php 
                    $Msg = "";
                        if(isset($_GET['error']))
                            {
                                $Msg = " Please Fill in the Blanks ";
                                echo $Msg ;
                            }

                            if(isset($_GET['success']))
                            {
                                $Msg = " Your Message Has Been Sent ";
                                echo $Msg;
                            }
                        
                        ?>
                    </div>
                    
                        <form action="process.php" method="post">
                            <input type="text" name="UName" placeholder="User Name">
                            <input type="email" name="Email" placeholder="Email">
                            <input type="text" name="Subject" placeholder="Subject">
                            <textarea name="msg" placeholder="Write The Message"></textarea>
                            <button name="btn-send" > Send </button>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>