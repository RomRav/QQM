<?php

require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../daos/Connexion.php';

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
//        print_r($ingredient);
        echo $ingredient->getIngredientName();
        $ingredientsList .= "<li class='list-group-item'> ";
        $ingredientsList.=$ingredient->getIngredientName() ." ";
        $ingredientsList.= $ingredient->getqty()." ";
        $ingredientsList.= $ingredient->getIdUOM() . "<br></li>";
    }
}

