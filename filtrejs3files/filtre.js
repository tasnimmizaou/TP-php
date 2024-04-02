function listener(buttonstable, submitterName, fatherName, callback){
    let submitter = document.querySelector(`#${submitterName}`);
    let father = document.querySelector(`div[name="${fatherName}"]`);
    let isAdded = false;
    submitter.addEventListener('click', ()=>{
        if (!isAdded) {
            buttonstable.forEach(element => {
                addButton(element, fatherName, callback);
                father.appendChild(document.createElement("br"));
            });
            isAdded=true;
        } else {
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false;
        }
    })
}

function sendDataToPHP(query) {
    // Envoi de la requête SQL au fichier PHP via une requête fetch
    fetch('filtre.php', {
        method: 'POST',
        body: JSON.stringify({ query: query }), // Envoyer la requête SQL sous forme d'objet JSON
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de la requête.'); // Gère les erreurs de réponse HTTP
        }
        return response.text(); // Convertit la réponse en texte
    })
    .then(data => {
        // Faites quelque chose avec la réponse
        console.log(data);
    })
    .catch(error => console.error('Error:', error.message));
}

function addButton(textcontent, fatherName, callback){
    let btn = document.createElement("button");
    btn.setAttribute("class", "button");
    btn.textContent=textcontent;
    btn.addEventListener("click", function(){
        let query = "";
        if (fatherName === 'nouveautes'){
            if (textcontent === "All") {
                query = "SELECT * FROM article WHERE date_ajout < DATE_SUB(NOW(), INTERVAL 3 MONTH)";
            } else {
                query = "SELECT * FROM article WHERE date_ajout < DATE_SUB(NOW(), INTERVAL 3 MONTH) AND age = '" + textcontent + "'";
            }
        }
        if (fatherName === 'soldes'){
            if (textcontent === "All") {
                query = "SELECT * FROM article WHERE reduction != 0";
            } else {
                query = "SELECT * FROM article WHERE reduction != 0 AND age = '" + textcontent + "'";
            }
        }
        if (fatherName === 'adultes'){
            if (textcontent === "All") {
                query = "SELECT * FROM article WHERE age = 'adulte'";
            } else {
                query = "SELECT * FROM article WHERE age = 'adulte' AND category = '" + textcontent + "'";
            }
        }
        if (fatherName === 'enfants'){
            if (textcontent === "All") {
                query = "SELECT * FROM article WHERE age = 'enfant'";
            } else {
                query = "SELECT * FROM article WHERE age = 'enfant' AND category = '" + textcontent + "';";
            }
        }

        callback(query);
    });
    let father = document.querySelector(`div[name="${fatherName}"]`);
    father.appendChild(btn);
}

listener(['All', 'Adultes', 'Enfants'],'nouveautesbutton', 'nouveautes', sendDataToPHP);
listener(['All', 'Adultes', 'Enfants'],'soldesbutton', 'soldes', sendDataToPHP);
listener(['All', 'Fragrances', 'Make Up', 'Accessoires', 'Robes', 'Chemises', 'Pantalons', 'Chaussures', 'Sportswear'],'adultesbutton', 'adultes', sendDataToPHP);
listener(['All', 'Fragrances', 'Make Up', 'Accessoires', 'Robes', 'Chemises', 'Pantalons', 'Chaussures', 'Sportswear'],'enfantsbutton', 'enfants', sendDataToPHP);
