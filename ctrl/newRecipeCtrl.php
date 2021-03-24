<?php

session_start();
/**
 * newRecipeCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 * last update: 24/03/2021
 */
require_once '../daos/Connexion.php';
require_once '../daos/TypeDAO.php';
require_once '../daos/SeasonDAO.php';
require_once '../daos/PositionDAO.php';
require_once '../daos/PaysDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../daos/RecipeDAO.php';
require_once '../daos/newRecipeDAO.php';
require_once '../ett/Type.php';
require_once '../ett/NewRecipe.php';
require_once '../daos/UniteOfMeasureDAO.php';


if (!isset($_SESSION['pseudo']) && !isset($_COOKIE['pseudo'])) {
    header("location: ../ctrl/routeur.php?route=authentification");
}

//Connexion 
$pdo = Connexion::seConnecter("../daos/bd.ini");
$pdo->beginTransaction();


//Récupération de la saisie du formulaire de création des recettes
$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
$season = filter_input(INPUT_POST, "season");
$position = filter_input(INPUT_POST, "position");
$contenue = filter_input(INPUT_POST, "contenue", FILTER_SANITIZE_SPECIAL_CHARS);
$contenuRecette = filter_input(INPUT_POST, "contenuRecette");
$ingredient = filter_input(INPUT_POST, "ingredient");
$country = filter_input(INPUT_POST, "country");
$choice = filter_input(INPUT_GET, "choice");
$idLogedCooker = $_SESSION["idCooker"];
$message = "";

if ($choice == "save") {
    //Liste des ingredients en tableau de la classe Ingredient
    $ingredientTable = explode(',', $ingredient);
    $itemId = 0;
    $ingredientObj = [];
    $ingredientObjTable = [];
    $ingredientInputChecked = true;
    for ($i = 0; $i < count($ingredientTable); $i++) {
        if ($itemId == 0) {
            $existIngredientInDb = IngredientDAO::selectOneByName($pdo, $ingredientTable[$i]);
            if ($existIngredientInDb->getIngredientName() == NULL) {
                $ingredientObjTable = null;
                $message = "L'ingredient $ingredientTable[$i] n'existe pas dans la base de données. Merci de contacter l'administrateur pour l'ajouter";
                $ingredientInputChecked = false;
            } else {
                $ingredientObj["name"] = $ingredientTable[$i];
                $ingredientObj["id"] = $existIngredientInDb->getIdIngredient();
            }
            $itemId = 1;
        } elseif ($itemId == 1) {
            $ingredientObj["qty"] = $ingredientTable[$i];
            $itemId = 2;
        } elseif ($itemId == 2) {
            $existUomInDb = UniteOfMeasureDAO::selectOneByName($pdo, $ingredientTable[$i]);
            if ($existUomInDb->getUom() == NULL) {
                $ingredientObjTable = null;
                $message = "L'unité de mesure $ingredientTable[$i] n'existe pas dans la base de données. Merci de contacter l'administrateur pour l'ajouter";
                $ingredientInputChecked = false;
            } else {
                $ingredientObj["uom"] = $existUomInDb->getIdUom();
            }
            $itemId = 0;
            $ingredientObjTable[] = $ingredientObj;
        }
    }
//Contrôle et enregistrement du contenu saisie dans le formulaire d'ajout d'une recette
    if ($ingredientInputChecked == true) {
        if (!isset($titre, $season, $position, $position, $contenuRecette, $ingredient, $country)) {
            $message = "L'un des champs n'a pas été rempli ou une caractéristique n'a pas été sélectionner.";
        } else {
            $file = $_FILES['imgFile']['error'];
            var_dump($file);
            $_FILES['imgFile']['name'] = $idLogedCooker . '-' . $titre . '.jpg';
            $nomFichier = $_FILES['imgFile']['tmp_name'];
            $photoFileName = basename($_FILES['imgFile']['name']);
            $photoFileError = $_FILES['imgFile']['error'];
            $isPhotoSave = move_uploaded_file($nomFichier, "../images/recipes_images/$photoFileName");
            echo 'aaaAAA' . $photoFileError;
            if ($isPhotoSave) {
                $newRecipe = new NewRecipe($titre, $season, $position, $contenue, $contenuRecette, $ingredientObjTable, $country, "");
//                echo '//' . $titre . '//' . $contenuRecette . ' // ' . $idLogedCooker . ' // ' . $photoFileName;
                $recRecipe = RecipeDAO::insert($pdo, $titre, $contenuRecette, '1', $idLogedCooker, $photoFileName);
                if ($recRecipe == 1) {
                    $newRecipeId = $pdo->lastInsertId();
                    $newRecipeLink = NewRecipeDAO::insertLinksOfNewRecipe($pdo, $newRecipeId, $newRecipe);
                    $pdo->commit();
                    $message .= $recRecipe . " recette bien enregistré";
                } else {
                    $pdo->rollBack();
                    $message = "L'enregistrement de la recette à échoué.";
                }
            }
        }
    }
}
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
    $selectCountry .= "<option value='" . $country->getIdUom() . "'>" . $country->getUom() . "</option>";
}
//Récupération de la liste des ingredients
$selectIngredient = "";
$ingredientTable = IngredientDAO::selectAll($pdo);
foreach ($ingredientTable as $ingredient) {
    $selectIngredient .= "<option value='" . $ingredient->getIdIngredient() . "'>" . $ingredient->getIngredientName() . "</option>";
}

if ($message != "") {
    include '../boundaries/newRecipeIHM.php';
}
?>

