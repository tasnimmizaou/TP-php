<?php
function generateChartData($query, $labelField, $dataField) {
    require_once 'commun/autoload.php';
    $pdo = ConnexionBD::getInstance();
    $stmt = $pdo->query($query);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $counts = [];
    foreach ($data as $row) {
        $labels[] = $row[$labelField];
        $counts[] = $row[$dataField];
    }

    return ['labels' => $labels, 'data' => $counts];
}
?>
