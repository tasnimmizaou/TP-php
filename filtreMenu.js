function listener1(submiter, fatherr) {
    let submitter = document.querySelector(submiter); 
    let isAdded = false; // Variable de statut pour suivre si les boutons sont déjà ajoutés
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherr); 
        
        if (!isAdded) { // Vérifie si les boutons n'ont pas encore été ajoutés
            let child1 = document.createElement('button');
            child1.textContent = "All";
            child1.classList.add("button");
            let child2 = document.createElement('button');
            child2.textContent = "Adultes";
            child2.classList.add("button");
            let child3 = document.createElement('button');
            child3.textContent = "Enfants";
            child3.classList.add("button");
            father.appendChild(child1);
            father.appendChild(document.createElement("br"));
            father.appendChild(child2);
            father.appendChild(document.createElement("br"));
            father.appendChild(child3);
            isAdded = true; // Met à jour la variable de statut après l'ajout des boutons
        } else {
            // Si les boutons sont déjà ajoutés, les supprimer
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false; // Met à jour la variable de statut après la suppression des boutons
        }
    });
}

listener1('#nouveautesbutton', '#nouveautés'); 
const soldesdiv = '#soldes';
listener1('#soldesbutton', soldesdiv);

function listener2(submiter, fatherr) {
    let submitter = document.querySelector(submiter); 
    let isAdded = false; // Variable de statut pour suivre si les boutons sont déjà ajoutés
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherr); 
        
        if (!isAdded) { // Vérifie si les boutons n'ont pas encore été ajoutés
            let child0 = document.createElement('button');
            child0.textContent = "All";
            child0.classList.add("button");
            
            let child1 = document.createElement('button');
            child1.textContent = "Fragrances";
            child1.classList.add("button");

            let child2 = document.createElement('button');
            child2.textContent = "Make Up";
            child2.classList.add("button");

            let child3 = document.createElement('button');
            child3.textContent = "accessoires";
            child3.classList.add("button");

            let child4 = document.createElement('button');
            child4.textContent = "robes";
            child4.classList.add("button");

            let child5 = document.createElement('button');
            child5.textContent = "chemises";
            child5.classList.add("button");

            let child6 = document.createElement('button');
            child6.textContent = "Pontalons";
            child6.classList.add("button");

            let child7 = document.createElement('button');
            child7.textContent = "Chaussures";
            child7.classList.add("button");

            let child8 = document.createElement('button');
            child8.textContent = "Sportswear";
            child8.classList.add("button");

            father.appendChild(child1);
            father.appendChild(document.createElement("br"));
            father.appendChild(child2);
            father.appendChild(document.createElement("br"));
            father.appendChild(child3);
            father.appendChild(document.createElement("br"));
            father.appendChild(child4);
            father.appendChild(document.createElement("br"));
            father.appendChild(child5);
            father.appendChild(document.createElement("br"));
            father.appendChild(child6);
            father.appendChild(document.createElement("br"));
            father.appendChild(child7);
            father.appendChild(document.createElement("br"));
            father.appendChild(child8);
            
            isAdded = true; // Met à jour la variable de statut après l'ajout des boutons
        } else {
            // Si les boutons sont déjà ajoutés, les supprimer
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false; // Met à jour la variable de statut après la suppression des boutons
        }
    });
}

listener2('#adultesbutton', '#adultes'); 
const enfantsdiv = '#enfants';
listener2('#enfantsbutton', enfantsdiv);

function listener3(submiter, fatherr) {
    let submitter = document.querySelector(submiter);
    let isAdded = false; // Variable de statut pour suivre si les éléments sont déjà ajoutés
    submitter.addEventListener("click", function (e) {
        e.preventDefault();
        let father = document.querySelector(fatherr);

        if (!isAdded) { // Vérifie si les éléments n'ont pas encore été ajoutés
            // Création des éléments input pour les prix min et max
            let prixMinInput = document.createElement('input');
            prixMinInput.type = 'number'; // Type de l'input est number
            prixMinInput.placeholder = 'Prix Min'; // Placeholder pour prix min
            prixMinInput.value = '0'; // Valeur par défaut pour prix min
            prixMinInput.classList.add("input"); // Ajout de classe pour le style CSS

            let prixMaxInput = document.createElement('input');
            prixMaxInput.type = 'number'; // Type de l'input est number
            prixMaxInput.placeholder = 'Prix Max'; // Placeholder pour prix max
            prixMaxInput.classList.add("input"); // Ajout de classe pour le style CSS

            father.appendChild(prixMinInput); // Ajout de l'input pour prix min
            father.appendChild(prixMaxInput); // Ajout de l'input pour prix max
            isAdded = true; // Met à jour la variable de statut après l'ajout des éléments
        } else {
            // Si les éléments sont déjà ajoutés, les supprimer
            while (father.firstChild) {
                father.removeChild(father.firstChild);
            }
            isAdded = false; // Met à jour la variable de statut après la suppression des éléments
        }
    });
}

listener3('#pricebutton', '#prix'); 