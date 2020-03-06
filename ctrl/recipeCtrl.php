<?php

require_once '../ett/Recipe.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/Connexion.php';

$pdo = Connexion::seConnecter('../daos/bd.ini');
$idSelectedRecipe = filter_input(INPUT_GET, 'id');

$selectedRecipe = RecipeDAO::selectOne($pdo, $idSelectedRecipe);
var_dump($selectedRecipe);

