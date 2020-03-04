<?php

require_once '../daos/connexion.php';
require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';


//Connexion
$pdo = Connexion::seConnecter('../daos/bd.ini');


//Récupération de la liste des recettes
$recipeTitleList = RecipeDAO::selectAllTitle($pdo);
if (count($recipeTitleList) > 0) {
    $list = '';
    $list.="<ol>";
    foreach ($recipeTitleList as $recipe) {
        $list.="<li><a href='routeur.php?route=recipe&id=" . $recipe->getIdRecipe() . "'>" . $recipe->getrecipeTitle() . "</a></li>";
    }
    $list.="</ol>";
}

