let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        let articleId = this.getAttribute('data-id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet article ?')) {
            let row = this.parentNode.parentNode; 
            row.parentNode.removeChild(row); 
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'supprimer.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status !== 200) {
                    alert('Erreur lors de la suppression de l\'article.');
                }
            };
            xhr.send('id=' + articleId);
        }
    });
});
let ajouter = document.querySelector('.addButton');
ajouter.addEventListener('click', function () {
    window.location.href = 'ajouter_article.php';
});
