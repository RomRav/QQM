<!DOCTYPE html>
<!--
recipeIHM Romain Ravault 01/03/2020 
Last update: 25/09/2020
-->

<?php
require_once '../ctrl/recipeCtrl.php';
?>
<html>
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
        include 'partials/nav.php';
        ?>
        <div class="container row">
            <?php echo $title ?>
        </div>
        <hr>
        <hr>
        <div class="container row">
            <div class="container col-7">
                <h2>Recette:</h2>
                <?php echo nl2br($recipe) ?>
            </div>
            <div class="container col-5">
                <h2>Ingredients:</h2>
                <?php ?>
            </div>
        </div>
    </body>
</html>



