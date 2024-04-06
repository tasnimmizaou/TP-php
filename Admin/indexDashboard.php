<?php
include('header.php');
include('navbar.php');
include("generateChart.php");
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="generateChart.js"></script>
<style>
    .chart-container {
        width: 300px;
        height: 300px;
    }

    .chart-wrapper {
        display: inline-block;
        margin-right: 20px;
    }
</style>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include('nav.php'); ?>

        <div class="chart-wrapper">
            <h5 class="text-center">Charts des catégories</h5>
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

        <div class="chart-wrapper">
            <h5 class="text-center">Charts des âges</h5>
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

<?php include("footer.php"); ?>
