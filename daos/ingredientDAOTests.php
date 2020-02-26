<?php

/*
 * Test des méthodes de la class ingredientDAO
 * @authore: Romain Ravault
 * 25/02/2020
 */

require_once 'IngredientDAO.php';
require_once '../ett/Ingredient.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les ingredients
$ingredients = IngredientDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($ingredients as $raw) {

    echo 'id ingredient: ' . $raw->getIdIngredient() . '  //***\\ nom de l\'ingredient: ' . $raw->getIngredientName() . ':' . $raw->getIngredientCalorie() . '  calorie.<br>';
}

//Test de la selection d'un ingredient
echo '<hr><br>SELECT UN INGREDIENT PAR SON ID<br><hr>';
$idIngredient = 1;
$ingredient = IngredientDAO::selectOne($pdo, $idIngredient);
echo 'id ingredient: ' . $ingredient->getIdIngredient() . '  //***\\ nom de l\'ingredient: ' . $ingredient->getIngredientName() . ':' . $ingredient->getIngredientCalorie() . ' calorie.<br>';



////Test de l'ajout d'un nouveau ingredient
//echo '<hr><br>AJOUTER UN INGREDIENT<br><hr>';
//$newIngredient = 'Panais';
//$newIngredientCalorie = 50;
//$addIngredient = IngredientDAO::insert($pdo, $newIngredient, $newIngredientCalorie);
//if ($addIngredient == 1) {
//    $pdo->commit();
//    echo $addIngredient . ' ingredient à bien été enregisté.';
//} else {
//    echo 'Enregistrement de l\'ingredient non réalisé.' . $addIngredient;
//    $pdo->rollBack();
//}
//Test de la supression d'un ingredient
//echo '<hr><br>SUPPRESSION D\'UN INGREDIENT<br><hr>';
//$toDeleteIdIngredient = 6;
//$deletedIngredient = IngredientDAO::delete($pdo, $toDeleteIdIngredient);
//if ($deletedIngredient == 1) {
//    $pdo->commit();
//    echo $deletedIngredient .' ingredient supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'un ingredient
//echo '<hr><br>Modifier un ingredient<br><hr>';
//$idIngredient = 7;
//$newIngredientName = 'panais';
//$newIngredientCalorie = 75;
//$updatedIngredientName = IngredientDAO::update($pdo, $idIngredient, $newIngredientName, $newIngredientCalorie);
//if ($updatedIngredientName == 1) {
//    $pdo->commit();
//    echo $updatedIngredientName . ' ingredient modifié.';
//} else {
//    $pdo->rollBack();
//    echo 'Ingredient non modifié.';
//}
//Deconnexion
Connexion::seDeconnecter($pdo);
