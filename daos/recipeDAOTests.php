<?php

/*
 * Test des méthodes de la class RecipeDAO
 * @authore: Romain Ravault
 * 26/02/2020
 */

require_once 'RecipeDAO.php';
require_once '../ett/Recipe.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de toutes les recettes
//$recipes = RecipeDAO::selectAll($pdo);
//echo '<hr><br>SELECT ALL<br><hr>';
//foreach ($recipes as $raw) {
//
//    echo 'id recipe: '
//    . $raw->getIdRecipe() . '  //***\ Titre de la recette: '
//    . $raw->getRecipeTitle() . '<br><hr> recette:<br>'
//    . nl2br($raw->getRecipe()) . '  .<br><hr><br> Recette visibilité:'
//    . $raw->getRecipeVisibility() . ' utilisateur n°:' . $raw->getIdCooker() .
//    '<br>************************************************************************************************************************************************************************<br>';
//}
//Test de la selection de toutes les titres de recettes
//$recipesTitle = RecipeDAO::selectAllTitle($pdo);
//echo '<hr><br>SELECT ALL TITLES<br><hr>';
//foreach ($recipesTitle as $raw) {
//
//    echo 'id recipe: '
//    . $raw->getIdRecipe() . '  //***\ Titre de la recette: '
//    . $raw->getRecipeTitle() . '<br><br>'
//    . '<br>************************************************************************************************************************************************************************<br>';
//}
////Test de la selection d'une recette
//echo '<hr><br>SELECT UNE RECETTE PAR SON ID<br><hr>';
//$idRecipe = 2;
//$recipe = RecipeDAO::selectOne($pdo, $idRecipe);
//echo 'id recipe: '
// . $recipe->getIdRecipe() . '  //***\ Titre de la recette: '
// . $recipe->getRecipeTitle() . '<br><hr> recette:<br>'
// . $recipe->getRecipe() . '  .<br><hr><br> Recette visibilité:'
// . $recipe->getRecipeVisibility() . ' utilisateur n°:' . $recipe->getidCooker();
////Test de l'ajout d'une nouvelle recette
//echo '<hr><br>AJOUTER UNE RECETTE<br><hr>';
//$newRecipeTitle = 'AAAAAA';
//
//$newRecipe = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA.';
//
//$newRecipeVisibility = 1;
//$newIdCooker = 1;
//$addRecipe = RecipeDAO::insert($pdo, $newRecipeTitle, $newRecipe, $newRecipeVisibility, $newIdCooker = 1);
//if ($addRecipe == 1) {
//    $pdo->commit();
//    echo $addRecipe . ' Recette à bien été enregisté.';
//} else {
//    echo 'Enregistrement de la recette non réalisé.' . $addRecipe;
//    $pdo->rollBack();
//}
//Test de la supression d'une recette
//echo '<hr><br>SUPPRESSION D\'UNE RECETTE<br><hr>';
//$toDeleteIdRecipe = 3;
//$deletedRecipe = RecipeDAO::delete($pdo, $toDeleteIdRecipe);
//if ($deletedRecipe == 1) {
//    $pdo->commit();
//    echo $deletedRecipe .' recette supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'une recette
//echo '<hr><br>Modifier une recette<br><hr>';
//$idRecipe = 4;
//$newRecipeTitle = 'aaaaaaaaaaaaaaaaaaaaaa';
//$newRecipe = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
//$newRecipeVisibility = 1;
//$newIdCooker = 1;
//$updatedRecipe = RecipeDAO::update($pdo, $idRecipe, $newRecipeTitle, $newRecipe, $newRecipeVisibility, $newIdCooker);
//if ($updatedRecipe == 1) {
//    $pdo->commit();
//    echo $updatedRecipe . ' recette modifié.';
//} else {
//    $pdo->rollBack();
//    echo 'Recette non modifié.';
//}
//Deconnexion
Connexion::seDeconnecter($pdo);
