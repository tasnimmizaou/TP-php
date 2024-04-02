let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let commandeId = this.getAttribute('data-id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
            // Supprimer la ligne de la commande dans le tableau
            let row = this.parentNode.parentNode; // Récupérer la ligne parente du bouton
            row.parentNode.removeChild(row); // Supprimer la ligne du tableau
            // Envoyer une requête AJAX pour supprimer la commande du côté serveur
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'supprimerCommande.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200) {
                    alert('Erreur lors de la suppression de la commande.');
                }
            };
            xhr.send('id=' + commandeId);
        }
    });
});

