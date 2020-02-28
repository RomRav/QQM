<?php

/**
 * newRecipeCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 */
require_once '../daos/Connexion.php';
require_once '../daos/TypeDAO.php';
require_once '../daos/SeasonDAO.php';
require_once '../daos/PositionDAO.php';
require_once '../daos/PaysDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../ett/Type.php';
require_once '../ett/newRecipe.php';

//Connexion 
$pdo = Connexion::seConnecter("../daos/bd.ini");

//Récupération de la saisie du formulaire de création des recettes
$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
$season = filter_input_array(INPUT_POST, "season[]");
$position = filter_input(INPUT_POST, "position");
$contenue = filter_input(INPUT_POST, "contenue", FILTER_SANITIZE_SPECIAL_CHARS);
$contenuRecette = filter_input(INPUT_POST, "contenuRecette");
$ingredient = filter_input(INPUT_POST, "ingredient");
$country = filter_input(INPUT_POST, "country");
$message = "";


//Contrôle et enregistrement du contenu saisie dans le formulaire d'ajout d'une recette
//if (!isset($titre, $season, $position, $position, $contenuRecette, $ingredient, $country)) {
//    $message = "L'un des champs n'a pas été rempli ou une caractéristique n'a pas été sélectionner.";
//} else {
//    $newRecipe = new NewRecipe($titre, $season, $position, $contenue, $contenuRecette, $ingredient, $country);
//  
//}
//Récupération de la liste des type de plats
$selectType = "";
$typesTable = TypeDAO::selectAll($pdo);
foreach ($typesTable as $type) {
    $selectType .= "<option value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
}
//Récupération de la liste des Saisons
$selectSeason = "";
$seasonTable = SeasonDAO::selectAll($pdo);
foreach ($seasonTable as $season) {
    $selectSeason .= "<option value='" . $season . "'>" . $season . "</option>";
}
//Récupération de la liste des positions
$selectPosition = "";
$positionTable = PositionDAO::selectAll($pdo);
foreach ($positionTable as $position) {
    $selectPosition .= "<option value='" . $position . "'>" . $position . "</option>";
}
//Récupération de la liste des pays
$selectCountry = "";
$countryTable = PaysDAO::selectAll($pdo);
foreach ($countryTable as $country) {
    $selectCountry .= "<option value='" . $country->getIdPays() . "'>" . $country->getPays() . "</option>";
}
//Récupération de la liste des ingredients
$selectIngredient = "";
$ingredientTable = IngredientDAO::selectAll($pdo);
foreach ($ingredientTable as $ingredient) {
    $selectIngredient .= "<option value='" . $ingredient->getIdIngredient() . "'>" . $ingredient->getIngredientName() . "</option>";
}
include '../boundaries/newRecipeIHM.php';
?>

