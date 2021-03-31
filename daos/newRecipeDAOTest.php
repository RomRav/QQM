<?php

/*
 * Test des méthodes de la class newRecipeDAO
 * @authore: Romain Ravault
 * 30/03/2021
 */

require_once 'newRecipeDAO.php';
require_once '../ett/newRecipe.php';
require_once '../ett/Ingredient.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la methode updateLinkOfRecipe()
echo "Test de la modification des liens entre les informations d'une recette et la recette.</br>";
//Crée un objet NewRecipe pour tester la méthode////////////////////////////////////////////////
$ingredientObjTable = [];
$ingredient = new Ingredient(2, 'pomme', 52, 100, 5);
$ingredient2 = new Ingredient(5, 'oeuf', 155, 2, 8);
array_push($ingredientObjTable, $ingredient, $ingredient2);
$recipeToUpdate = new NewRecipe("Tarte aux pommes", "hiver", "dessert", 6, "Mettre les pommes sur la pate!!", $ingredientObjTable, 2, " ");

$test = NewRecipeDAO::updateLinkOfRecipe($pdo, 71, $recipeToUpdate);
if($test == 1){
    $pdo->commit();
    echo "</br>Résultat".$test."// liens recette bien modifié.</br>";
} else {
    $pdo->rollBack();
    echo "</br>Résultat".$test."// liens recette non  modifié.</br>";
}

