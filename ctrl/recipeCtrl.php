<?php

require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/Connexion.php';

$pdo = Connexion::seConnecter('../daos/bd.ini');
$idSelectedRecipe = filter_input(INPUT_GET, 'id');

$selectedRecipe = RecipeDAO::selectOne($pdo, $idSelectedRecipe);
if ($selectedRecipe != NULL) {

    $title = "<h1>" . $selectedRecipe->getRecipeTitle() . "</h1>";
    $recipe = "<p>" . $selectedRecipe->getRecipe() . "</p>";
}

