<?php

/*
 * Test des méthodes de la class UniteOfMeasureDAO
 * @authore: Romain Ravault
 * 23/09/2020
 */

require_once 'UniteOfMeasureDAO.php';
require_once '../ett/UniteOfMeasure.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les unites de mesure
$uom = UniteOfMeasureDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($uom as $raw) {
    echo 'id uom: ' . $raw->getIdUom() . '  //***\\ nom de l\'unité de mesure ' . $raw->getUom() . '.<br>';
}

//Test de la selection d'une unité de mesure
echo '<hr><br>SELECT UNE UNITE DE MESURE PAR SON ID<br><hr>';
$idUom = 5;
$uom = UniteOfMeasureDAO::selectOne($pdo, $idUom);
echo 'id uom: ' . $uom->getIdUom() . '  //***\\ nom de l\'unité de mesure: ' . $uom->getUom() . '.<br>';


//Test de la selection d'une unité de mesure par son nom
echo '<hr><br>SELECT UNE UNITE DE MESURE PAR SON NOM<br><hr>';
$uomName = 'kg';
$uom = UniteOfMeasureDAO::selectOneByName($pdo, $uomName);
echo 'id uom: ' . $uom->getIdUom() . '  //***\\ nom de l\'unité de mesure: ' . $uom->getUom() . '.<br>';


////Test de l'ajout d'une nouvelle unité de mesure
//echo '<hr><br>AJOUTER UNE UNITE DE MESURE<br><hr>';
//$newUom = 'dl';
//
//$addUom = UniteOfMeasureDAO::insert($pdo, $newUom);
//if ($addUom == 1) {
//    $pdo->commit();
//    echo $addUom . ' unité de mesure à bien été enregisté.';
//} else {
//    echo 'Enregistrement non réalisé.' . $addUom;
//    $pdo->rollBack();
//}
//Test de la supression d'un pays
//echo '<hr><br>SUPPRESSION D\'UNE UNITE DE MESURE<br><hr>';
//$toDeleteIdUom = 10;
//$deletedUom = UniteOfMeasureDAO::delete($pdo, $toDeleteIdUom);
//if ($deletedUom == 1) {
//    $pdo->commit();
//    echo $deletedUom . ' unité de mesure supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'un pays
//echo '<hr><br>Modifier un pays<br><hr>';
//$idUom = 11;
//$newUomName = 'dl';
//$updatedUomName = UniteOfMeasureDAO::update($pdo, $idUom, $newUomName);
//if ($updatedUomName == 1) {
//    $pdo->commit();
//    echo $updatedUomName . ' unité de mesure modifié.';
//} else {
//    $pdo->rollBack();
//    echo 'Unité de mesure non modifié.';
//}
//Deconnexion
Connexion::seDeconnecter($pdo);
