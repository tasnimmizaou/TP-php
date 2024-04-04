let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let clientId = this.getAttribute('data-id');
        if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
            let row = this.parentNode.parentNode; 
            row.parentNode.removeChild(row);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'supprimerClient.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200) {
                    alert('Erreur lors de la suppression du client.');
                }
            };
            xhr.send('id=' + clientId);
        }
    });
});
let ajouter = document.querySelector('.addButton');
ajouter.addEventListener('click', function () {
    window.location.href = 'ajouterClient.php';
});
