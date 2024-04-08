<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du Mode de Paiement</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff; 
            color: #fff; 
            padding: 50px;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M0 0h60v60H0z" fill="%23ffffff" fill-opacity=".1"/%3E%3Cpath d="M21 54h18v3H21zM3 54h15v3H3zM54 54h3v3h-3zM54 36h3v15h-3zM54 3v15h3V3zM36 3h15v3H36zM3 3h15v3H3zM21 3h18v3H21zM3 21h15v3H3zM54 21h3v15h-3zM21 36h18v3H21zM36 21h15v3H36z"/%3E%3C/g%3E%3C/svg%3E');
        }
        .payment-options {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            margin-top: 50px;
        }
        .payment-option {
            text-align: center;
            margin-bottom: 20px; 
        }
        .payment-option button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>      Mode de Paiement</h1>
    <div class="payment-options">
        <div class="payment-option">
            <img src="https://icons.getbootstrap.com/assets/icons/credit-card-fill.svg" alt="Visa" class="mb-3" width="64" height="64">
            <br>
            <button onclick="selectPayment('Visa')" class="btn btn-light">Payer avec Visa</button>
        </div>
        <div class="payment-option">
            <img src="https://icons.getbootstrap.com/assets/icons/paypal.svg" alt="PayPal" class="mb-3" width="64" height="64">
            <br>
            <button onclick="selectPayment('PayPal')" class="btn btn-light">Payer avec PayPal</button>
        </div>
        <div class="payment-option">
            <i class="fas fa-coins fa-3x mb-3"></i>
            <br>
            <button onclick="selectPayment('Espèces')" class="btn btn-light">Payer en espèces</button>
        </div>
    </div>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function selectPayment(paymentMethod) {
            
            alert('Méthode de paiement sélectionnée : ' + paymentMethod);
        }
    </script>
</body>
</html>
