let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let recordId = this.getAttribute('data-id');
        let tableName = this.getAttribute('data-table');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) {
            let row = this.parentNode.parentNode;
            row.parentNode.removeChild(row);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'supprimer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200) {
                    alert('Erreur lors de la suppression de l\'enregistrement.');
                }
            };
            xhr.send('id=' + recordId + '&table=' + tableName);
        }
    });
});
