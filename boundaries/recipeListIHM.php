<!DOCTYPE html>
<!--
recipeListIHM.php
@authore: Romain Ravault
04/03/2020
Last update: 10/12/2020
-->
<?php
require_once '../ctrl/recipeListCtrl.php';
?>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>Qu'est-ce qu'on mange?</title>
    </head>
    <body>
        <?php
        include 'partials/header.php';
        echo '<h2>Liste des recettes</h2>';
        echo $message;
        echo '<div class="recipe_list">';
        echo $list;
        ?>
    </div>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="../js/jquery.js"></script>
</body>
</html>