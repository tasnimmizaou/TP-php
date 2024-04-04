let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let adminId = this.getAttribute('data-id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet admin ?')) {
            let row = this.parentNode.parentNode; 
            row.parentNode.removeChild(row);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'supprimerAdmin.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200) {
                    alert('Erreur lors de la suppression de l\'admin.');
                }
            };
            xhr.send('id=' + adminId);
        }
    });
});
let ajouter = document.querySelector('.addButton');
ajouter.addEventListener('click', function () {
    window.location.href = 'ajouterAdmin.php';
});
