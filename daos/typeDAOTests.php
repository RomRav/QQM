<?php

/*
 * Test des méthodes de la class typeDAOTest
 * @authore: Romain Ravault
 * 24/02/2020
 * Last update 24/02/2020
 */

require_once 'TypeDAO.php';
require_once '../ett/Type.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les types
$types = TypeDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($types as $raw) {

    echo 'id type: ' . $raw->getIdType() . '  //***\\ nom du type de plat: ' . $raw->getTypeName() . '.<br>';
}

//Test de la selection d'un type
echo '<hr><br>SELECT UN TYPE PAR SON ID<br><hr>';
$idType = 1;
$type = TypeDAO::selectOne($pdo, $idType);
echo 'id type: ' . $type->getIdType() . '  //***\\ nom du type: ' . $type->getTypeName() . '.<br>';



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
$idPays = 43;
$newCountryName = 'chine';
$updatedCountryName = PaysDAO::update($pdo, $idPays, $newCountryName);
if ($updatedCountryName == 1) {
    $pdo->commit();
    echo $updatedCountryName . ' pays modifié.';
} else {
    $pdo->rollBack();
    echo 'Pays non modifié.';
}


//Deconnexion
Connexion::seDeconnecter($pdo);
