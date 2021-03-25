<?php

session_start();
/**
 * recipeCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 * last update: 24/03/2021
 */
require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../daos/Connexion.php';


if (!isset($_SESSION['pseudo']) && !isset($_COOKIE['pseudo'])) {
    header("location: ../ctrl/routeur.php?route=authentification");
}
$pdo = Connexion::seConnecter('../daos/bd.ini');
$pdo->beginTransaction();
$idSelectedRecipe = filter_input(INPUT_GET, 'id');
$choix = filter_input(INPUT_GET, 'choix', FILTER_SANITIZE_SPECIAL_CHARS);
if ($choix == 'del') {
    $delResp = RecipeDAO::delete($pdo, $idSelectedRecipe);
    $message = checkResponseAndMessage($delResp, $pdo);
    header('location:../ctrl/routeur.php?route=recipeList&message=' . $message);
}
$selectedRecipe = RecipeDAO::selectOne($pdo, $idSelectedRecipe);
$ingredients = IngredientDAO::selectOnePlus($pdo, $idSelectedRecipe);
if ($selectedRecipe != NULL) {
    $title = "<h1>" . $selectedRecipe->getRecipeTitle() . "</h1>";
    $idRecipe = "<p class=idRecipe>" . $selectedRecipe->getIdRecipe() . "</p>";
    $recipe = "<p>" . $selectedRecipe->getRecipe() . "</p>";
}
$ingredientsList = "<ul class='list-group'>";
if ($ingredients != NULL) {
    foreach ($ingredients as $ingredient) {
        $ingredientsList .= "<li class='list-group-item'> ";
        $ingredientsList .= $ingredient->getIngredientName() . " ";
        $ingredientsList .= $ingredient->getqty() . " ";
        $ingredientsList .= $ingredient->getIdUOM() . "<br></li>";
    }
}

function checkResponseAndMessage($resp, $pdo) {
    $message = "";
    if ($resp == 1) {
        $pdo->commit();
        $message = 'Recette supprimé';
    } else {
        $message = 'Recette non supprimé';
        $pdo->rollBack();
    }
    return $message;
}
