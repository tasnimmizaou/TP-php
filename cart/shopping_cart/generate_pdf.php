<?php
require_once('../TCPDF-main/tcpdf.php');
require_once "autoload.php";
require_once "cart.php";  

// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if cart items are set in the session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $cartItems = $cart->getItems();
    $totalPrice = $cart->getTotalPriceAfterReduction(); // Assuming this method is defined in your Cart class

    if ($totalPrice > 0) {
        // Create a new TCPDF instance
        $pdf = new TCPDF();

        // Set document metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Girlhood');
        $pdf->SetTitle('Facture');
        $pdf->SetSubject('Les achats');

        // Add a page to the document
        $pdf->AddPage();

        // Write content to the PDF
        $pdf->SetFont('helvetica', 'B', 20); // Augmenter la taille de police
        $pdf->Cell(0, 10, 'Facture', 0, 1, 'C');
        $pdf->Ln(20); // Ajouter un espace

        $pdf->SetFont('helvetica', '', 16); // Taille de police normale
        foreach ($cartItems as $item) {
            $product = $item->getProduct();
            $quantity = $item->getQuantity();
            $productName = $product->getName();
            // Get the price after reduction
            $itemPrice = $item->getTotalPriceAfterReduction();
            
            // Texte pour chaque ligne
            $text = "Product: $productName\nQuantity: $quantity\nPrice after reduction: $itemPrice"; // Updated line
            
            // Centrer le texte et afficher sur plusieurs lignes
            $pdf->MultiCell(0, 15, $text, 0, 'C');
            $pdf->Ln(10); // Espacement entre les éléments
        }

        $pdf->Ln(20); // Espacement après les produits
        $pdf->Cell(0, 10, "Total Price: $totalPrice", 0, 1);

        // Output the PDF as a download
        $pdf->Output('facture.pdf', 'D');

        // Clean the output buffer and flush it
        ob_end_clean();
    } else {
        echo "Error: Total price is zero.";
    }
} else {
    // Handle case where cart items are not set
    echo "Error: Cart items not found.";
}
?>
