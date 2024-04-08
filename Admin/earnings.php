<?php
require_once 'autoloader.php'; 

function calculateTotalEarningsAndSales() {
$pdo = ConnexionBD::getInstance();

    $query1 = "SELECT SUM(total_price) AS total_earnings, COUNT(*) AS total_sales FROM commande";
    $stmt1 = $pdo->query($query1);
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $totalEarnings = $result1['total_earnings'];
    $totalSales = $result1['total_sales'];

    $query2 = "SELECT COUNT(*) AS total_clients FROM user";
    $stmt2 = $pdo->query($query2);
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $totalClients = $result2['total_clients'];

    return ['earnings' => $totalEarnings, 'sales' => $totalSales, 'clients' => $totalClients];
}

?>
