<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard d'administration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php require_once 'table_dashboard.php' ?>
<script>
    let ajouter = document.querySelector('#ajouter');
    let modifier = document.querySelector('#modifier');
    let supprimer = document.querySelector('#supprimer');

    ajouter.addEventListener('click', function () {
        window.location.href = 'ajouter_article.php';
    });

    modifier.addEventListener('click', function () {
        redirection('modifier')
    });

    supprimer.addEventListener('click', function () {
        alert('Veuillez sélectionner une ligne à supprimer.');
        let rows = document.querySelectorAll('tr');

        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                let selectedRowId = row.cells[0].textContent; // Première cellule contient l'ID
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'supprimer.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        let dashboardTable = document.getElementById('dashboard');
                        dashboardTable.deleteRow(row.rowIndex);
                    } else {
                        alert('Erreur lors de la suppression de l\'article.');
                    }
                };
                xhr.send('id=' + selectedRowId);

            });
        });
    });
    function redirection(file) {
        alert('Veuillez sélectionner une ligne à modifier.');
        let rows = document.querySelectorAll('tr');

        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                let selectedRowId = row.cells[0].textContent;
                window.location.href = file + '.php?id=' + selectedRowId;
            });
        });
    }
</script>
</body>
</html>
