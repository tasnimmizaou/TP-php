let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let commandeId = this.getAttribute('data-id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
=            let row = this.parentNode.parentNode; 
            row.parentNode.removeChild(row); 
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

