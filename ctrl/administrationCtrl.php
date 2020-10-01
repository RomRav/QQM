<?php

/**
 * administrationCtrl.php
 * @authore : Romain Ravault
 * 30/09/2020
 *
 * last update: 30/09/2020
 */
require_once '../daos/Connexion.php';
require_once '../daos/CookerDAO.php';
require_once '../daos/TypeDAO.php';
require_once '../daos/SeasonDAO.php';
require_once '../daos/UniteOfMeasureDAO.php';
require_once '../daos/PositionDAO.php';
require_once '../daos/PaysDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/newRecipeDAO.php';
require_once '../ett/Type.php';
require_once '../ett/NewRecipe.php';
require_once '../daos/UniteOfMeasureDAO.php';

//Connexion 
$pdo = Connexion::seConnecter("../daos/bd.ini");
$pdo->beginTransaction();


//Récupération de la saisie du formulaire de création des recettes
//$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
//$season = filter_input(INPUT_POST, "season");
//$position = filter_input(INPUT_POST, "position");
//$contenue = filter_input(INPUT_POST, "contenue", FILTER_SANITIZE_SPECIAL_CHARS);
//$contenuRecette = filter_input(INPUT_POST, "contenuRecette");
//$ingredient = filter_input(INPUT_POST, "ingredient");
//$country = filter_input(INPUT_POST, "country");
$choice = filter_input(INPUT_GET, "choice");
$category = filter_input(INPUT_GET, "cat");
//$message = "";
if ($choice != null) {
    echo $choice . $category;
    $message = 'ok';
}


//Récupération de la liste des cooker
$selectCooker = "";
$cookerTable = CookerDAO::selectAll($pdo);
foreach ($cookerTable as $cooker) {
    $selectCooker .= "<option value='" . $cooker->getIdCooker() . "'>" . $cooker->getPseudo() . "</option>";
}
//Récupération de la liste des type de plats
$selectType = "";
$typesTable = TypeDAO::selectAll($pdo);
foreach ($typesTable as $type) {
    $selectType .= "<option value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
}
////Récupération de la liste des Unité de mesure
$selectUom = "";
$uomTable = UniteOfMeasureDAO::selectAll($pdo);
foreach ($uomTable as $uom) {
    $selectUom .= "<option value='" . $uom->getIdUom() . "'>" . $uom->getUom() . "</option>";
}
////Récupération de la liste des positions
$selectPosition = "";
$positionTable = PositionDAO::selectAll($pdo);
foreach ($positionTable as $position) {
    $selectPosition .= "<option value='" . $position . "'>" . $position . "</option>";
}
////Récupération de la liste des pays
$selectCountry = "";
$countryTable = PaysDAO::selectAll($pdo);
foreach ($countryTable as $country) {
    $selectCountry .= "<option value='" . $country->getIdUom() . "'>" . $country->getUom() . "</option>";
}
////Récupération de la liste des ingredients
$selectIngredient = "";
$ingredientTable = IngredientDAO::selectAll($pdo);
foreach ($ingredientTable as $ingredient) {
    $selectIngredient .= "<option value='" . $ingredient->getIdIngredient() . "'>" . $ingredient->getIngredientName() . "</option>";
}














if ($message != "") {
    include '../boundaries/administrationIHM.php';
}
?>

