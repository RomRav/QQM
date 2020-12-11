<?php

session_start();
/**
 * recipeListCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 * last update: 11/12/2020
 */
require_once '../daos/connexion.php';
require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';

//Connexion
$pdo = Connexion::seConnecter();
//Récupération de la liste des recettes ou des recettes de l'utilisateur logger
if (isset($_SESSION['idCooker'])) {
    $idCooker = $_SESSION['idCooker'];
    $recipeTitleList = RecipeDAO::selectTitleByIdCooker($pdo, $idCooker);
    if (count($recipeTitleList) > 0) {
        $list = recipeCardBuilder($recipeTitleList);
    } else {
        $list = "<p>Vous n'avez aucune recette d'enregistré.</p>";
    }
} else {
    $recipeTitleList = RecipeDAO::selectAllTitle($pdo);

    if (count($recipeTitleList) > 0) {
        $list = recipeCardBuilder($recipeTitleList);
    }
}

function recipeCardBuilder($recipeTitleList) {
    if (count($recipeTitleList) > 0) {
        $list = '';
        foreach ($recipeTitleList as $recipe) {
            $list .= "<div class='list_item'>";
            $list .= "<img class='card-img' src='../images/recipes_images/" . $recipe->getPhotoFileName() . "'/>";
            $list .= "<a href='routeur.php?route=recipe&id=" . $recipe->getIdRecipe() . "'>" . $recipe->getrecipeTitle() . "</a>";
            $list .= "</div>";
        }
    }
    return $list;
}
