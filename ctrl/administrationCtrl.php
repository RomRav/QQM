<?php

/**
 * administrationCtrl.php
 * @authore : Romain Ravault
 * 30/09/2020
 *
 * last update: 07/10/2020
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
$inputedUom = filter_input(INPUT_POST, "uom", FILTER_SANITIZE_SPECIAL_CHARS);

$selectedPosition = filter_input(INPUT_POST, "selectPosition");
$selectedCooker = filter_input(INPUT_POST, "selectCooker");
$selectedIngredient = filter_input(INPUT_POST, "selectIngredient");
$selectedCountry = filter_input(INPUT_POST, "selectCountry");
$selectedType = filter_input(INPUT_POST, "selectType");
$selectedUom = filter_input(INPUT_POST, 'selectUom');

//Récupération de l'item et de l'action choisie
$selectedItem = filter_input(INPUT_GET, "choice");
$selectedAction = filter_input(INPUT_GET, "cat");
$message = "ok";

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
            if ($inputedCooker && $selectedCooker) {
                $upCooker = CookerDAO::update($pdo, $selectedCooker, $inputedCooker, "123");
                $message = checkResponseAndMessage($upCooker, $pdo);
            } elseif ($inputedCooker) {
                $addCooker = CookerDAO::insert($pdo, $inputedCooker, "123");
                $message = checkResponseAndMessage($addCooker, $pdo);
            } elseif ($selectedCooker) {
                $delCooker = CookerDAO::delete($pdo, $selectedCooker);
                $message = checkResponseAndMessage($delCooker, $pdo);
            }
            break;
        case "type":
            $typeForm = formBuilder($selectedItem, $selectedAction, $selectType);
            $cookerForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            if ($inputedType && $selectedType) {
                $upType = TypeDAO::update($pdo, $selectedType, $inputedType);
                $message = checkResponseAndMessage($upType, $pdo);
            } elseif ($inputedType) {
                $addType = TypeDAO::insert($pdo, $inputedType);
                $message = checkResponseAndMessage($addType, $pdo);
            } elseif ($selectedType) {
                $delType = TypeDAO::delete($pdo, $selectedType);
                $message = checkResponseAndMessage($delType, $pdo);
            }
            break;
        case "country":
            $countryForm = formBuilder($selectedItem, $selectedAction, $selectCountry);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $uomForm = "";
            $positionForm = "";
            if ($inputedCountry && $selectedCountry) {
                $upCountry = PaysDAO::update($pdo, $selectedCountry, $inputedCountry);
                $message = checkResponseAndMessage($upType, $pdo);
            } elseif ($inputedCountry) {
                $addType = PaysDAO::insert($pdo, $inputedCountry);
                $message = checkResponseAndMessage($addType, $pdo);
            } elseif ($selectedCountry) {
                $delType = PaysDAO::delete($pdo, $selectedCountry);
                $message = checkResponseAndMessage($delType, $pdo);
            }
            break;
        case "ingredient":
            $ingredientForm = formBuilder($selectedItem, $selectedAction, $selectIngredient);
            $cookerForm = "";
            $typeForm = "";
            $countryForm = "";
            $uomForm = "";
            $positionForm = "";
            if ($inputedIngredient && $selectedIngredient) {
                $upIngredient = IngredientDAO::update($pdo, $selectedIngredient, $inputedIngredient, "30");
                $message = checkResponseAndMessage($upIngredient, $pdo);
            } elseif ($inputedIngredient) {
                $addIngredient = IngredientDAO::insert($pdo, $inputedIngredient, "30");
                $message = checkResponseAndMessage($addIngredient, $pdo);
            } elseif ($selectedIngredient) {
                $delIngredient = IngredientDAO::delete($pdo, $selectedIngredient);
                $message = checkResponseAndMessage($delIngredient, $pdo);
            }
            break;
        case "position":
            $positionForm = formBuilder($selectedItem, $selectedAction, $selectPosition);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $uomForm = "";
            if ($inputedPosition && $selectedPosition) {
                $upPosition = PositionDAO::update($pdo, $selectedPosition, $inputedPosition);
                $message = checkResponseAndMessage($upPosition, $pdo);
            } elseif ($inputedPosition) {
                $addPosition = PositionDAO::insert($pdo, $inputedPosition);
                $message = checkResponseAndMessage($addPosition, $pdo);
            } elseif ($selectedPosition) {
                $delPosition = PositionDAO::delete($pdo, $selectedPosition);
                $message = checkResponseAndMessage($delPosition, $pdo);
            }
            break;
        case "uom":
            $uomForm = formBuilder($selectedItem, $selectedAction, $selectUom);
            $cookerForm = "";
            $typeForm = "";
            $ingredientForm = "";
            $countryForm = "";
            $positionForm = "";
            if ($inputedUom && $selectedUom) {
                $upUom = UniteOfMeasureDAO::update($pdo, $selectedUom, $inputedUom);
                $message = checkResponseAndMessage($upUom, $pdo);
            } elseif ($inputedUom) {
                $addUom = UniteOfMeasureDAO::insert($pdo, $inputedUom);
                $message = checkResponseAndMessage($addUom, $pdo);
            } elseif ($selectedUom) {
                $delUom = UniteOfMeasureDAO::delete($pdo, $selectedUom);
                $message = checkResponseAndMessage($delUom, $pdo);
            }
            break;
    }
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

function checkResponseAndMessage($resp, $pdo) {
    $message = "";
    if ($resp == 1) {
        $pdo->commit();
        $message = 'OK';
    } else {
        $message = 'KO';
        $pdo->rollBack();
    }
    return $message;
}

if ($message != "") {
    include '../boundaries/administrationIHM.php';
}
?>

