function addButton(textContent, father,fatherID, callback){
    const button = document.createElement('button');
    button.textContent = textContent;
    button.classList.add('button');
    father.appendChild(button);
    button.addEventListener('click', function() {
        let query = "";
        if (fatherID === '#nouveautes'){
            if (textContent === "All") {
                query = "SELECT * FROM article WHERE date_ajout < DATE_SUB(NOW(), INTERVAL 3 MONTH)";
            } else {
                query = "SELECT * FROM article WHERE date_ajout < DATE_SUB(NOW(), INTERVAL 3 MONTH) AND age = '" + textContent + "'";
            }
        }
        if (fatherID === '#soldes'){
            if (textContent === "All") {
                query = "SELECT * FROM article WHERE reduction != 0";
            } else {
                query = "SELECT * FROM article WHERE reduction != 0 AND age = '" + textContent + "'";
            }
        }
        if (fatherID === '#adultes'){
            if (textContent === "All") {
                query = "SELECT * FROM article WHERE age = 'adulte'";
            } else {
                query = "SELECT * FROM article WHERE age = 'adulte' AND category = '" + textContent + "'";
            }
        }
        if (fatherID === '#enfants'){
            if (textContent === "All") {
                query = "SELECT * FROM article WHERE age = 'enfant'";
            } else {
                query = "SELECT * FROM article WHERE age = 'enfant' AND category = '" + textContent + "'";
            }
        }
        
        callback(query); // Appel de la fonction de rappel avec le texte du bouton comme argument
    });
}
function addCategoryButtons(buttonLabels, fatherId, callback) {
    const father = document.querySelector(fatherId);
    buttonLabels.forEach(label => {
        addButton(label, father,fatherId, callback);
        father.appendChild(document.createElement("br"));
    });
}

function addPriceInput(father, placeHolder){
    const priceInput = document.createElement('input');
    priceInput.type = 'number'; 
    priceInput.placeholder = placeHolder; 
    priceInput.classList.add("input");
    if (placeHolder === "Prix  Min") {
        priceInput.value = '0';
    }
    father.appendChild(priceInput);
}

function listener1(submitterID, fatherID, callback) {
    let submitter = document.querySelector(submitterID);
    let isAdded = false; // Variable de statut pour suivre si les boutons sont déjà ajoutés
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherID); 
        if (!isAdded) {
            addCategoryButtons(["All", "Adultes", "Enfants"], fatherID, callback);
            isAdded = true;
        } else {
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false;
        }
    });
}

function listener2(submiter,fatherID, callback) {
    let submitter = document.querySelector(submiter); 
    let isAdded = false;
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherID);
        
        if (!isAdded) {
            addCategoryButtons(["All", "Fragrances", "Make Up", "Accessoires", "Robes", "Chemises", "Pontalons", "Chaussures", "Sportswear"], fatherID, callback);
            isAdded = true;
        } else {
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false;
        }
    });
}

function listener3(submiter, fatherr) {
    let submitter = document.querySelector(submiter);
    let isAdded = false;
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherr);

        if (!isAdded) {
            addPriceInput(father,"Prix  Min" );
            addPriceInput(father,"Prix  Max" );

            isAdded = true;
        } else {
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false;
        }
    });
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


listener1('#nouveautesbutton', '#nouveautes', sendDataToPHP);
listener1('#soldesbutton', '#soldes', sendDataToPHP);
listener2('#adultesbutton', '#adultes', sendDataToPHP);
listener2('#enfantsbutton', '#enfants', sendDataToPHP);
listener3('#pricebutton', '#prix');

