<?php

/*
 * header.php
 * Romain Ravault
 * Laste update 07/01/2020
 */
?>
<header>
    <h1>Qu'est-ce qu'on mange?!</h1>
    <nav class="navbar navbar-expand-lg bg-light">
        <ul class="list-group list-group-horizontal">
            <?php
          
            if (isset($_SESSION['cooker'])) {
                echo '<li class="list-nav">
                <a class="ml-1 list-group-item list-group-item-action" href="../boundaries/newRecipeIHM.php">Ajoutez une recette</a>
            </li>
            &nbsp;&nbsp;';
            } else {
                echo '<li class="list-nav">
                <a class="ml-1 list-group-item list-group-item-action" href="../ctrl/routeur.php?route=authentification">Authentification</a>
            </li>
            &nbsp;&nbsp;';
            }
            ?>
            <li class="list-nav">
                <a class="ml-1 list-group-item list-group-item-action" href="../ctrl/routeur.php?route=recipeList">Liste des recettes</a>
            </li>
            &nbsp;&nbsp;

            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                echo '<li class = "list-nav">
            <a class = "ml-1 list-group-item list-group-item-action" href = "../ctrl/routeur.php?route=administration">Administration</a>
            </li>';
            }
            ?>
            &nbsp;&nbsp;
            <li class="list-nav">
                <a href="../ctrl/deconnexion.php"><img src="../images/deco.jpg" /></a>
            </li>
            &nbsp;&nbsp;
        </ul>
    </nav>
</header>
