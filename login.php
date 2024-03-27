<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<form name ='login' action="login.php" method="post" frameborder="0">
        <fieldset>
        <legend>Login</legend>
        <label> Mail :</label > <input   type="email" placeholder="votre adresse email"    name="ml"  /><br /><br />
        <label> mdp:</label><input type="password" placeholder="votre password" name="psd" /><br /><br />
        <label> nom:</label><input type="text" placeholder="votre nom " name="n" /><br /><br />
        <label> prenom :</label> <input type="text" placeholder="votre prenom " name="pn" /><br /><br />
        <label> date de naissance :</label> <input type="date" name="dn" /><br /><br />
        <label>Genre :</label><input type="radio" name="ge" value="Homme" /> homme 
                              <input type="radio" name="ge" value="Femme" />  femme <br /><br />
         
         <label> photo de profil :</label> <input type="file" name="pdp" /><br /><br />
                            
         <input type="submit" value="Sign Up !" class="signup"  onclick="return verif()"/>
        <input type="reset" value="Annuler" class="annul" />
        
        </fieldset>
        </form>
</body>
</html>