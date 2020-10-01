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
$message = "";

//Récupération de la liste des cooker
$selectCooker = "<select name='cooker'>";
$cookerTable = CookerDAO::selectAll($pdo);
foreach ($cookerTable as $cooker) {
    $selectCooker .= "<option value='" . $cooker->getIdCooker() . "'>" . $cooker->getPseudo() . "</option>";
}
$selectCooker.="</select>";

//Récupération de la liste des type de plats
$selectType = "<select name='type'>";
$typesTable = TypeDAO::selectAll($pdo);
foreach ($typesTable as $type) {
    $selectType .= "<option value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
}
$selectType.="</select>";

////Récupération de la liste des Unité de mesure
$selectUom = "<select name='uom'>";
$uomTable = UniteOfMeasureDAO::selectAll($pdo);
foreach ($uomTable as $uom) {
    $selectUom .= "<option value='" . $uom->getIdUom() . "'>" . $uom->getUom() . "</option>";
}
$selectUom.="</select>";

////Récupération de la liste des positions
$selectPosition = "<select name='position'>";
$positionTable = PositionDAO::selectAll($pdo);
foreach ($positionTable as $position) {
    $selectPosition .= "<option value='" . $position . "'>" . $position . "</option>";
}
$selectPosition.="</select>";

////Récupération de la liste des pays
$selectCountry = "<select name='country'>";
$countryTable = PaysDAO::selectAll($pdo);
foreach ($countryTable as $country) {
    $selectCountry .= "<option value='" . $country->getIdUom() . "'>" . $country->getUom() . "</option>";
}
$selectCountry.="</select>";

////Récupération de la liste des ingredients
$selectIngredient = "<select name='ingredient'>";
$ingredientTable = IngredientDAO::selectAll($pdo);
foreach ($ingredientTable as $ingredient) {
    $selectIngredient .= "<option value='" . $ingredient->getIdIngredient() . "'>" . $ingredient->getIngredientName() . "</option>";
}
$selectIngredient.="</select>";

//Appel de la methode formBuilder() avec les arguments nécessaire en fonction du choix utilisateur
if ($choice != null) {
    switch ($choice) {
        case "cooker":
            $cookerForm = formBuilder($choice, $category, $selectCooker);
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "type":
            $typeForm = formBuilder($choice, $category, $selectType);
            $cookerForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "country":
            $countryForm = formBuilder($choice, $category, $selectCountry);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "ingredient":
            $ingredientForm = formBuilder($choice, $category, $selectIngredient);
            $cookerForm = "";
            $typeForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "position":
            $positionForm = formBuilder($choice, $category, $selectPosition);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            break;
        case "uom":
            $uomForm = formBuilder($choice, $category, $selectUom);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $positionForm = "";
            break;
    }
    $message = 'ok';
} else {
    $cookerForm = "";
    $typeForm = "";
    $ingredientForm = "";
    $countryForm = "";
    $uomForm = "";
    $positionForm = "";
}

/**
 * Methode formBiolder crée le formulaire en fonction de l'action désiré (CUD) sur l'item choisit
 * @authore : Romain Ravault
 * 01/10/2020
 * @param type $choice
 * @param type $cat
 * @param type $select
 * @return string
 */
function formBuilder($choice, $cat, $select) {
    $formulaire = "<h5>$cat</h5><form action='../boundaries/administrationCtrl.php' methode = 'POST'>";
    $button = "<button type='button' class='btn-primary'>Valider</button>";
    $input = "<input type='text' class='form-control'>";
    switch ($cat) {
        case 'delete':
            $formulaire.= $select . '<br><br>';
            $formulaire.=$button;
            $formulaire.="</form><br>";
            break;
        case 'update' :
            $formulaire.= $select . '<br><br>';
            $formulaire.=$input;
            $formulaire.=$button;
            $formulaire.="</form><br>";
            break;
        case 'add':
            $formulaire.=$input;
            $formulaire.=$button;
            $formulaire.="</form><br>";
            break;
    }
    return $formulaire;
}

if ($message != "") {
    include '../boundaries/administrationIHM.php';
}
?>

