
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter</title>
    <style>
        .button {
    background-color: transparent;
    border: none;
    outline: none;
    font-size: 20px;
    color: white;
    margin-bottom: 10px;
    font-family: Arial, sans-serif;
    /* Ajoutez d'autres styles spécifiques à vos besoins */
}

.button:hover {
    /* Styles lorsque le curseur survole le bouton */
    /* Vous pouvez laisser cette partie vide si vous ne voulez aucun effet de survol */
    /* Par exemple, vous pouvez changer la couleur du texte ou ajouter une légère opacité */
    opacity: 0.8; /* Réduit l'opacité à 80% lors du survol */
}
div{padding-left: 40px;}
form{padding-top: 50px;}

    </style>
</head>
<body>
    
        <form id="filter-form" method="POST" action="filtre.php"> 

        <button class="button" id = "nouveautesbutton">Nouveautés</button><br>
        <div id="nouveautés"  > </div>

        <button class="button"id = "soldesbutton">Soldes</button><br>
        <div id="soldes"  ></div>

        <button class="button" id="adultesbutton">Adultes</button><br>
        <div id="adultes" ></div>

        <button class="button" id="enfantsbutton">Enfants</button><br>
        <div id="enfants" ></div>

        <button class="button" id = "pricebutton">Prix</button><br>
        <div id = "prix" ></div>
 
</form>

<script src = "filtreMenu.js" > </script>
</body>
</html>
