<?php
require_once ("../commun/autoload.php");
require_once ("../commun/ConnexionBD.php");
require_once "Cart.php";



//session_start();

function placeOrder()
{ // Vérifie si le panier est présent dans la session et récupère les articles
    if (isset($_SESSION['cart'])) {
        $cart = Cart::getCartInstance(1);  
        $cartItems = $cart->getItems();
    } else {
        echo " empty.";
        return false;
   }

    try {
        $connexionBD = ConnexionBD::getInstance();
        $totalPrice = 0;
        $userId = 1; // Remplacez ceci par votre méthode pour obtenir l'ID de l'utilisateur connecté

        // Commence la transaction
        $connexionBD->beginTransaction();

        // Insérer la commande dans la table `commande`
        $insertCommandeQuery = "INSERT INTO commande (user_id, date_commande, total_price) VALUES (:userId, CURRENT_TIMESTAMP, :totalPrice)";
        $stmtCommande = $connexionBD->prepare($insertCommandeQuery);
        $stmtCommande->bindParam(':userId', $userId);
        $stmtCommande->bindParam(':totalPrice', $totalPrice);
        $stmtCommande->execute();

        // Récupérer l'ID de la commande insérée
        $commandeId = $connexionBD->lastInsertId();

        // Insérer les détails de la commande dans la table `details_commande`
        $insertDetailsQuery = "INSERT INTO details_commande (commande_id, article_id, quantity, prix_unitaire) VALUES (:commandeId, :articleId, :quantity, :prixUnitaire)";
        $stmtDetails = $connexionBD->prepare($insertDetailsQuery);

        foreach ($cartItems as $item) {
            $product = $item->getProduct();
            $quantity = $item->getQuantity();
            $prix_unitaire = $product->getPrice();

            $totalPrice += $prix_unitaire * $quantity;

            $stmtDetails->bindParam(':commandeId', $commandeId);
            $stmtDetails->bindParam(':articleId', $product->getId());
            $stmtDetails->bindParam(':quantity', $quantity);
            $stmtDetails->bindParam(':prixUnitaire', $prix_unitaire);
            $stmtDetails->execute();
        }

        // Mettre à jour le 'total_price' dans la table `commande`
        $updateCommandeQuery = "UPDATE commande SET total_price = :totalPrice WHERE id = :commandeId";
        $stmtUpdateCommande = $connexionBD->prepare($updateCommandeQuery);
        $stmtUpdateCommande->bindParam(':totalPrice', $totalPrice);
        $stmtUpdateCommande->bindParam(':commandeId', $commandeId);
        $stmtUpdateCommande->execute();

        // Valider la transaction
        $connexionBD->commit();

        // Réinitialiser le panier après la commande
        unset($_SESSION['cart']);

        return true; // Indiquer le succès
    } catch (PDOException $e) {
        $connexionBD->rollBack();
        echo "Error: " . $e->getMessage();
        return false; // Indiquer l'échec
    }
}


?>
