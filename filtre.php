<?php

require_once('DatabaseConnection.php');
require_once('Article.php');
require_once('ArticleManager.php');

$db = new DatabaseConnection('localhost', 'root', '', 'girlhood'); // Update credentials if needed
$articleManager = new ArticleManager($db);

$filters = []; // Array to store filters (category, age, saison, price, name)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['category'])) {
    $filters['category'] = $_POST['category'];
  }

  if (isset($_POST['age'])) {
    $filters['age'] = $_POST['age'];
  }

  // Add logic to handle other filters (saison, price, name) based on their presence in $_POST

  $articles = $articleManager->getAllArticles(); // Initial query

  if (!empty($filters)) {
    foreach ($filters as $filterKey => $filterValue) {
      switch ($filterKey) {
        case 'category':
          $articles = $articleManager->filterBycategory($filterValue);
          break;
        case 'age':
          $articles = $articleManager->filterByage($filterValue); // Implement this method in articlemanager.php
          break;
        case 'saison':
          $articles = $articleManager->filterBysaison($filterValue);
          break;
      }
    }
  }
}
?>
