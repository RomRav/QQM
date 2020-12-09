<?php

require_once '../daos/connexion.php';
require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';


//Connexion
$pdo = Connexion::seConnecter();


//Récupération de la liste des recettes ou des recettes de l'utilisateur logger
$recipeTitleList = RecipeDAO::selectAllTitle($pdo);
if (count($recipeTitleList) > 0) {
    $list = '';
    foreach ($recipeTitleList as $recipe) {
        $list.="<div class='list_item'>";
        $list.="<a href='routeur.php?route=recipe&id=" . $recipe->getIdRecipe() . "'>" . $recipe->getrecipeTitle() . "</a>";
        $list.="</div>";
    }
}

