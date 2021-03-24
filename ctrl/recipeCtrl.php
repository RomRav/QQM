<?php
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
$idSelectedRecipe = filter_input(INPUT_GET, 'id');

$selectedRecipe = RecipeDAO::selectOne($pdo, $idSelectedRecipe);
$ingredients = IngredientDAO::selectOnePlus($pdo, $idSelectedRecipe);
if ($selectedRecipe != NULL) {
    $title = "<h1>" . $selectedRecipe->getRecipeTitle() . "</h1>";
    $recipe = "<p>" . $selectedRecipe->getRecipe() . "</p>";
}
$ingredientsList = "<ul class='list-group'>";
if ($ingredients != NULL) {
    foreach ($ingredients as $ingredient) {
        $ingredientsList .= "<li class='list-group-item'> ";
        $ingredientsList.=$ingredient->getIngredientName() ." ";
        $ingredientsList.= $ingredient->getqty()." ";
        $ingredientsList.= $ingredient->getIdUOM() . "<br></li>";
    }
}

