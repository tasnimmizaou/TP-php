<?php
include('header.php');
include('navbar.php');
include("generateChart.php");
include("earnings.php");
$earningsAndSales = calculateTotalEarningsAndSales();
$totalEarnings = $earningsAndSales['earnings'];
$totalSales = $earningsAndSales['sales'];
$totalClients=$earningsAndSales['clients'];
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="generateChart.js"></script>
<style>
    .chart-container {
        width: 300px;
        height: 300px;
    }

    .chart-wrapper {
        margin-right: 20px;
    }
</style>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <?php include('nav.php'); ?>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Earnings </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalEarnings  ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        sales </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalSales  ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        clients </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalClients  ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Charts des catégories</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-wrapper">
                                <div class="chart-container">
                                    <canvas id="myChart1"></canvas>
                                </div>
                                <?php
                                $query1 = "SELECT category, COUNT(*) AS count FROM article INNER JOIN details_commande ON article.id = details_commande.article_id GROUP BY category";
                                $chartData1 = generateChartData($query1, 'category', 'count');
                                ?>
                                <script>
                                    const ctx1 = document.getElementById('myChart1');
                                    generateChart(ctx1, 'pie', <?php echo json_encode($chartData1); ?>, 'Nombre d\'articles vendus par catégorie');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Charts des âges</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-wrapper">
                                <div class="chart-container">
                                    <canvas id="myChart2"></canvas>
                                </div>
                                <?php
                                $query2 = "SELECT age, COUNT(*) AS count FROM article INNER JOIN details_commande ON article.id = details_commande.article_id GROUP BY age";
                                $chartData2 = generateChartData($query2, 'age', 'count');
                                ?>
                                <script>
                                    const ctx2 = document.getElementById('myChart2');
                                    generateChart(ctx2, 'pie', <?php echo json_encode($chartData2); ?>, 'Nombre d\'articles vendus par âge');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");include("scripts.php") ?>
