<?php

/*
 * Test des méthodes de la class PaysDAO
 * @authore: Romain Ravault
 * 20/02/2020
 * Last update 24/02/2020
 */

require_once 'PaysDAO.php';
require_once '../ett/Pays.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les pays
$country = PaysDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($country as $raw) {
    //var_dump($raw);
    //$enr = new Pays($raw[0], $raw[1]);
    echo 'id pays: ' . $raw->getIdUom() . '  //***\\ nom du pays: ' . $raw->getUom() . '.<br>';
}

//Test de la selection d'un pays
echo '<hr><br>SELECT UNE PAYS PAR SON ID<br><hr>';
$idUom = 1;
$country = PaysDAO::selectOne($pdo, $idUom);
echo 'id pays: ' . $country->getIdUom() . '  //***\\ nom du pays: ' . $country->getUom() . '.<br>';



////Test de l'ajout d'un nouveau pays
//echo '<hr><br>AJOUTER UN PAYS<br><hr>';
//$newCountry = 'Chine';
//
//$addCountry = PaysDAO::insert($pdo, $newCountry);
//if ($addCountry == 1) {
//    $pdo->commit();
//    echo $addCountry . ' pays à bien été enregisté.';
//} else {
//    echo 'Enregistrement du pays non réalisé.' . $addCountry;
//    $pdo->rollBack();
//}
//Test de la supression d'un pays
//echo '<hr><br>SUPPRESSION D\'UN PAYS<br><hr>';
//$toDeleteIdCountry = 42;
//$deletedCountry = PaysDAO::delete($pdo, $toDeleteIdCountry);
//if ($deletedCountry == 1) {
//    $pdo->commit();
//    echo $deletedCountry .' pays supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'un pays
echo '<hr><br>Modifier un pays<br><hr>';
$idUom = 43;
$newUomName = 'chine';
$updatedUomName = PaysDAO::update($pdo, $idUom, $newUomName);
if ($updatedUomName == 1) {
    $pdo->commit();
    echo $updatedUomName . ' pays modifié.';
} else {
    $pdo->rollBack();
    echo 'Pays non modifié.';
}


//Deconnexion
Connexion::seDeconnecter($pdo);
