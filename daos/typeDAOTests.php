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



////Test de l'ajout d'un nouveau type
//echo '<hr><br>AJOUTER UN TYPE<br><hr>';
//$newType = 'aa';
//
//$addType = TypeDAO::insert($pdo, $newType);
//if ($addType == 1) {
//    $pdo->commit();
//    echo $addType . ' type de plat à bien été enregisté.';
//} else {
//    echo 'Enregistrement du type de plat non réalisé.' . $addType;
//    $pdo->rollBack();
//}
//Test de la supression d'un type de plat
//echo '<hr><br>SUPPRESSION D\'UN TYPE DE PLAT<br><hr>';
//$toDeleteIdType = 7;
//$deletedType = TypeDAO::delete($pdo, $toDeleteIdType);
//if ($deletedType == 1) {
//    $pdo->commit();
//    echo $deletedType .' type de plat supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'un type
echo '<hr><br>Modifier un type de plat<br><hr>';
$idType = 6;
$newTypeName = 'tarte';
$updatedTypeName = TypeDAO::update($pdo, $idType, $newTypeName);
if ($updatedTypeName == 1) {
    $pdo->commit();
    echo $updatedTypeName . ' type de plat modifié.';
} else {
    $pdo->rollBack();
    echo 'Type de plat non modifié.';
}


//Deconnexion
Connexion::seDeconnecter($pdo);
