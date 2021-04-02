<?php
/*
 * header.php
 * Romain Ravault
 * Last update 24/03/2021
 */
?>
<div class="head_background"></div>
<header>
    <h3>Qu'est-ce qu'on mange?!</h3>
    <nav class="head_nav">
        <ul class="head_ul">
            <?php
            
            if (isset($_SESSION['pseudo'])) {
                echo '<li class="head_li">
                    
                <a class="head_a"  href="../boundaries/newRecipeIHM.php">Ajoutez une recette</a>
               
            </li>
            &nbsp;&nbsp;';
                echo '<li class="head_li">

                <a class="head_a" href="../ctrl/routeur.php?route=recipeList">Liste des recettes</a>

            </li>
            &nbsp;&nbsp;';
                echo '<li class="head_li">
                    
                <a class="head_a"  href="../ctrl/routeur.php?route=accountManager">Mon compte</a>
               
            </li>
            &nbsp;&nbsp;';
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    echo '<li class="head_li">
            <a class="head_a" href = "../ctrl/routeur.php?route=administration">Administration</a>
            </li>
            &nbsp;&nbsp;';
                }
            } else {
                echo '<li class="head_li">
                <a class="head_a" href="../ctrl/routeur.php?route=authentification">Authentification</a>
            </li>
            &nbsp;&nbsp;';
            }
            ?>            <li class="head_li">
                <a class="head_a" href="../ctrl/deconnexion.php"><img src="../images/logout.png" /></a>
            </li>


            &nbsp;&nbsp;
        </ul>
    </nav>
</header>
