<?php

session_start();
/**
 * newRecipeCtrl.php
 * @authore : Romain Ravault
 * 28/02/2020
 * last update: 02/04/2021
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
require_once '../ett/Cooker.php';
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
$ingredients = trim(filter_input(INPUT_POST, "ingredient"));
$country = filter_input(INPUT_POST, "country");
$choice = filter_input(INPUT_GET, "choice");
$idLogedCooker = $_SESSION["idCooker"];
$recipeToUpdateId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$message = "";
$ingredientsToString = "";
$typeToUpdate = new Type(null, null);
$seasonToUpdate = null;
$positionToUpdate = null;
$countryToUpdate = new Pays(null, null);
$recipeToUpdate = new Recipe(null, null, null, null, null, null);
//Vérification de la présence de l'id d'une recette à modifier
if ($recipeToUpdateId) {
    $choice = "update";
    $recipeToUpdate = RecipeDAO::selectOne($pdo, $recipeToUpdateId);
    //Vérification que l'utilisateur a l'autorisation de modifier la recette
    if ($recipeToUpdate->getIdCooker() == $idLogedCooker) {
        //Récupération de tous les informations de la recette à modifier.
        $ingredientsToUpdate = IngredientDAO::selectOnePlus($pdo, intval($recipeToUpdateId));
        $countryToUpdate = PaysDAO::selectCountryOfARecepie($pdo, $recipeToUpdateId);
        $seasonToUpdate = SeasonDAO::selectSeasonOfARecepie($pdo, $recipeToUpdateId);
        $positionToUpdate = PositionDAO::selectPositionOfARecepie($pdo, $recipeToUpdateId);
        $typeToUpdate = TypeDAO::selectTypeOfARecepie($pdo, $recipeToUpdateId);
        //Création d'une String avec le contenu du tableau d'ingredients
        if ($ingredientsToUpdate != NULL) {
            foreach ($ingredientsToUpdate as $ingredient) {
                $ingredientsToString .= $ingredient->getIngredientName() . ",";
                $ingredientsToString .= $ingredient->getqty() . ",";
                $ingredientsToString .= $ingredient->getIdUOM() . "";
            }
        }
        $message = "Vous pouvez modifier la recette.";
    } else {
        $message = "Vous n'avez pas le droit de modifier cette recette.";
        header("location: ../boundaries/recipeListIHM.php?message=" . $message);
    }
} else {
    $choice = "save";
}
if ($choice == "save" || $choice == 'update') {
    //Liste des ingredients en tableau de la classe Ingredient
    $ingredientTable = explode(',', $ingredients);
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
                $ingredientObj["uom"] = trim($existUomInDb->getIdUom());
            }
            $itemId = 0;
            $ingredientObjTable[] = $ingredientObj;
        }
    }
//Contrôle et enregistrement du contenu saisie dans le formulaire d'ajout d'une recette
    if ($ingredientInputChecked == true) {
        if (!isset($titre, $season, $position, $position, $contenuRecette, $ingredients, $country)) {
            $message = "L'un des champs n'a pas été rempli ou une caractéristique n'a pas été sélectionner.";
        } else {
            $fileError = $_FILES['imgFile']['error'];
            $_FILES['imgFile']['name'] = $idLogedCooker . '-' . $titre . '.jpg';
            $nomFichier = $_FILES['imgFile']['tmp_name'];
            $photoFileName = $fileError != 4 ? basename($_FILES['imgFile']['name']) : 'default.jpg';
            $photoFileError = $_FILES['imgFile']['error'];
            $isPhotoSave = move_uploaded_file($nomFichier, "../images/recipes_images/$photoFileName");
            if ($isPhotoSave || $fileError == 4) {
                $newRecipe = new NewRecipe($titre, $season, $position, $contenue, $contenuRecette, $ingredientObjTable, $country, "");
//                echo '//' . $titre . '//' . $contenuRecette . ' // ' . $idLogedCooker . ' // ' . $photoFileName;
                echo $choice;
                if ($choice == 'save') {
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
                } else {
                    $recRecipe = RecipeDAO::update($pdo, $recipeToUpdateId, $titre, $contenuRecette, '1', $idLogedCooker, $photoFileName);
                    if ($recRecipe == 1) {
                        $newRecipeId = $recipeToUpdateId;
                        $newRecipeLink = NewRecipeDAO::updateLinkOfRecipe($pdo, $newRecipeId, $newRecipe);
                        $pdo->commit();
                        $message .= $recRecipe . " recette bien enregistré";
                    } else {
                        $pdo->rollBack();
                        $message = "L'enregistrement de la recette à échoué.";
                    }
                }
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
    if ($type->getIdType() == $typeToUpdate->getIdType()) {
        $selectType .= "<option selected='selected' value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
    } else {
        $selectType .= "<option value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
    }
}
//Récupération de la liste des Saisons
$selectSeason = "";
$seasonTable = SeasonDAO::selectAll($pdo);
foreach ($seasonTable as $season) {
    if ($season == $seasonToUpdate) {
        $selectSeason .= "<option selected='selected' value='" . $season . "'>" . $season . "</option>";
    } else {
        $selectSeason .= "<option value='" . $season . "'>" . $season . "</option>";
    }
}
//Récupération de la liste des positions
$selectPosition = "";
$positionTable = PositionDAO::selectAll($pdo);
foreach ($positionTable as $position) {
    if ($positionToUpdate == $position) {
        $selectPosition .= "<option selected='selected' value='" . $position . "'>" . $position . "</option>";
    } else {
        $selectPosition .= "<option value='" . $position . "'>" . $position . "</option>";
    }
}
//Récupération de la liste des pays
$selectCountry = "";
$countryTable = PaysDAO::selectAll($pdo);
foreach ($countryTable as $country) {
    if ($country->getIdPays() == $countryToUpdate->getIdPays()) {
        $selectCountry .= "<option selected='selected' value='" . $country->getIdPays() . "'>" . $country->getPays() . "</option>";
    } else {
        $selectCountry .= "<option value='" . $country->getIdPays() . "'>" . $country->getPays() . "</option>";
    }
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

