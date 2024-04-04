<?php
// Démarrer la session
session_start();

// Vérifier si un utilisateur est connecté (vous pouvez ajouter d'autres conditions si nécessaire)
if (isset($_SESSION['user_id'])) {
    // Détruire la session actuelle
    session_unset(); // Effacer toutes les données de la session
    session_destroy(); // Détruire la session complètement
}

// Vous pouvez ajouter des messages ou des actions supplémentaires après la déconnexion si nécessaire

// Terminer le script
exit();
?>
