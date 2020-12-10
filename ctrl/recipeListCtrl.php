<?php

session_start();
/**
 * recipeListCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 *
 * last update: 10/12/2020
 */
require_once '../daos/connexion.php';
require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';


//Connexion
$pdo = Connexion::seConnecter();
//Récupération de la liste des recettes ou des recettes de l'utilisateur logger
if (isset($_SESSION['cooker'])) {
    $cooker = $_SESSION['cooker'];
    $idCooker = $cooker->getIdCooker();
    echo $idCooker;
    $recipeTitleList = RecipeDAO::selectTitleByIdCooker($pdo, $idCooker);
    if (count($recipeTitleList) > 0) {
        $list = '';
        foreach ($recipeTitleList as $recipe) {
            $list .= "<div class='list_item'>";
            $list .= "<a href='routeur.php?route=recipe&id=" . $recipe->getIdRecipe() . "'>" . $recipe->getrecipeTitle() . "</a>";
            $list .= "</div>";
        }
    }
} else {
    $recipeTitleList = RecipeDAO::selectAllTitle($pdo);
    if (count($recipeTitleList) > 0) {
        $list = '';
        foreach ($recipeTitleList as $recipe) {
            $list .= "<div class='list_item'>";
            $list .= "<a href='routeur.php?route=recipe&id=" . $recipe->getIdRecipe() . "'>" . $recipe->getrecipeTitle() . "</a>";
            $list .= "</div>";
        }
    }
}

