// Fonction pour supprimer un produit du panier
function removeProduct(productId) {
    // Envoyer une requête AJAX au serveur pour supprimer le produit du panier
    $.ajax({
        url: 'remove_product.php', 
        type: 'POST',
        data: { product_id: productId },
        success: function(response) {
            // Actualiser la page après la suppression du produit
            location.reload();
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs 
            console.error(error);
        }
    });
}
