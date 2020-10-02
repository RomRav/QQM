<?php

/**
 * administrationCtrl.php
 * @authore : Romain Ravault
 * 30/09/2020
 *
 * last update: 02/10/2020
 */
require_once '../daos/Connexion.php';
require_once '../daos/CookerDAO.php';
require_once '../daos/TypeDAO.php';
require_once '../daos/UniteOfMeasureDAO.php';
require_once '../daos/PositionDAO.php';
require_once '../daos/PaysDAO.php';
require_once '../daos/IngredientDAO.php';
require_once '../daos/UniteOfMeasureDAO.php';

//Connexion 
$pdo = Connexion::seConnecter("../daos/bd.ini");
$pdo->beginTransaction();


//Récupération de la saisie des formulaires administrateur
$inputedPosition = filter_input(INPUT_POST, "position", FILTER_SANITIZE_SPECIAL_CHARS);
$inputedCooker = filter_input(INPUT_POST, "cooker", FILTER_SANITIZE_SPECIAL_CHARS);
$inputedIngredient = filter_input(INPUT_POST, "ingredient", FILTER_SANITIZE_SPECIAL_CHARS);
$inputedCountry = filter_input(INPUT_POST, "country", FILTER_SANITIZE_SPECIAL_CHARS);
$inputedType = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$inputedUOM = filter_input(INPUT_POST, "uom", FILTER_SANITIZE_SPECIAL_CHARS);

$selectedPosition = filter_input(INPUT_POST, "selectPosition");
$selectedCooker = filter_input(INPUT_POST, "selectCooker");
$selectedIngredient = filter_input(INPUT_POST, "selectIngredient");
$selectedCountry = filter_input(INPUT_POST, "selectCountry");
$selectedType = filter_input(INPUT_POST, "selectType");
$selectedUom = filter_input(INPUT_POST, 'selectUom');

//Récupération de l'item et de l'action choisie
$selectedItem = filter_input(INPUT_GET, "choice");
$selectedAction = filter_input(INPUT_GET, "cat");
$message = "";

//Récupération de la liste des cooker
$selectCooker = "<select name='selectCooker'><option value='' >Selectionner</option>";
$cookerTable = CookerDAO::selectAll($pdo);
foreach ($cookerTable as $cooker) {
    $selectCooker .= "<option value='" . $cooker->getIdCooker() . "'>" . $cooker->getPseudo() . "</option>";
}
$selectCooker.="</select>";

//Récupération de la liste des type de plats
$selectType = "<select name='selectType'><option value='' >Selectionner</option>";
$typesTable = TypeDAO::selectAll($pdo);
foreach ($typesTable as $type) {
    $selectType .= "<option value='" . $type->getIdType() . "'>" . $type->getTypeName() . "</option>";
}
$selectType.="</select>";

////Récupération de la liste des Unité de mesure
$selectUom = "<select name='selectUom'><option value='' >Selectionner</option>";
$uomTable = UniteOfMeasureDAO::selectAll($pdo);
foreach ($uomTable as $uom) {
    $selectUom .= "<option value='" . $uom->getIdUom() . "'>" . $uom->getUom() . "</option>";
}
$selectUom.="</select>";

////Récupération de la liste des positions
$selectPosition = "<select name='selectPosition'><option value='' >Selectionner</option>";
$positionTable = PositionDAO::selectAll($pdo);
foreach ($positionTable as $position) {
    $selectPosition .= "<option value='" . $position . "'>" . $position . "</option>";
}
$selectPosition.="</select>";

////Récupération de la liste des pays
$selectCountry = "<select name='selectCountry'><option value='' >Selectionner</option>";
$countryTable = PaysDAO::selectAll($pdo);
foreach ($countryTable as $country) {
    $selectCountry .= "<option value='" . $country->getIdUom() . "'>" . $country->getUom() . "</option>";
}
$selectCountry.="</select>";

////Récupération de la liste des ingredients
$selectIngredient = "<select name='selectIngredient'><option value='' >Selectionner</option>";
$ingredientTable = IngredientDAO::selectAll($pdo);
foreach ($ingredientTable as $ingredient) {
    $selectIngredient .= "<option value='" . $ingredient->getIdIngredient() . "'>" . $ingredient->getIngredientName() . "</option>";
}
$selectIngredient.="</select>";

//Appel de la methode formBuilder() avec les arguments nécessaire en fonction du choix utilisateur
if ($selectedItem != null) {
    switch ($selectedItem) {
        case "cooker":
            $cookerForm = formBuilder($selectedItem, $selectedAction, $selectCooker);
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            if ($inputedCooker || $selectedCooker) {
                if($selectedCooker!=""){
                    
                }  else {
                $message ="Sélection non fait";    
                }
                echo $inputedCooker;
                echo $selectedCooker;
            }
            break;
        case "type":
            $typeForm = formBuilder($selectedItem, $selectedAction, $selectType);
            $cookerForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "country":
            $countryForm = formBuilder($selectedItem, $selectedAction, $selectCountry);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "ingredient":
            $ingredientForm = formBuilder($selectedItem, $selectedAction, $selectIngredient);
            $cookerForm = "";
            $typeForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            break;
        case "position":
            $positionForm = formBuilder($selectedItem, $selectedAction, $selectPosition);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            break;
        case "uom":
            $uomForm = formBuilder($selectedItem, $selectedAction, $selectUom);
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
 * LAST UPDATE 02/10/2020
 * @param type $choice
 * @param type $cat
 * @param type $select
 * @return string
 */
function formBuilder($choice, $cat, $select) {
    $formulaire = "<h5>$cat</h5><form action='../ctrl/administrationCtrl.php?choice=$choice&cat=$cat' method='POST'>";
    $button = "<button type='submit' class='btn-primary'>Valider</button>";
    $input = "<input type='text' class='form-control' name='$choice'>";
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

