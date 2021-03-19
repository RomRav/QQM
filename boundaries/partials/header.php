<?php
/*
 * header.php
 * Romain Ravault
 * Laste update 17/03/2021
 */
?>
<div class="head_background"></div>
<header>
    <h3>Qu'est-ce qu'on mange?!</h3>
    <nav class="head_nav">
        <ul class="head_ul">
            <?php
            if (isset($_SESSION['cooker'])) {
                echo '<li class="head_li">
                    
                <a class="head_a"  href="../boundaries/newRecipeIHM.php">Ajoutez une recette</a>
               
            </li>
            &nbsp;&nbsp;';
            } else {
                echo '<li class="head_li">
                <a class="head_a" href="../ctrl/routeur.php?route=authentification">Authentification</a>
            </li>
            &nbsp;&nbsp;';
            }
            ?>
            <li class="head_li">

                <a class="head_a" href="../ctrl/routeur.php?route=recipeList">Liste des recettes</a>

            </li>
            &nbsp;&nbsp;

            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                echo '<li class="head_li">
            <a class="head_a" href = "../ctrl/routeur.php?route=administration">Administration</a>
            </li>';
            }
            ?>
            &nbsp;&nbsp;
            <li class="head_li">
                <a class="head_a" href="../ctrl/deconnexion.php"><img src="../images/logout(3).png" /></a>
            </li>
            &nbsp;&nbsp;
        </ul>
    </nav>
</header>
