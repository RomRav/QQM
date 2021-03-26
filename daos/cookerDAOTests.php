<?php

/*
 * Test des méthodes de la class CookerDAO
 * @authore: Romain Ravault
 * 26/02/2020
 */

require_once 'CookerDAO.php';
require_once '../ett/Cooker.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les Utilisteurs
$cookers = cookerDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($cookers as $raw) {

    echo 'id cooker: ' . $raw->getIdCooker() . '  //***\ pseudo: ' . $raw->getPseudo() . ' pwd:' . $raw->getPwd() . '  .<br>';
}

//Test de la selection d'un utilisateur
echo '<hr><br>SELECT UN UTILISATEUR PAR SON ID<br><hr>';
$idCooker = 1;
$cooker = cookerDAO::selectOne($pdo, $idCooker);
echo 'id cooker: ' . $cooker->getIdCooker() . '  //***\ pseudo: ' . $cooker->getPseudo() . ' pwd:' . $cooker->getPwd() . '.<br>';

//Test de la selection d'un utilisateur par son pseudo
//echo '<hr><br>SELECT UN UTILISATEUR PAR SON PSEUDO<br><hr>';
//$pseudo = "romain";
//$cooker = cookerDAO::selectOneByPseudo($pdo, $pseudo);
//echo 'id cooker: ' . $cooker->getIdCooker() . '  //***\ pseudo: ' . $cooker->getPseudo() . ' pwd:' . $cooker->getPwd() . '.<br>';
////Test de l'ajout d'un nouveau utilisateur
//echo '<hr><br>AJOUTER UN UTILISATEUR<br><hr>';
//$newCooker = 'Robin';
//$newCookerPwd = 159;
//$admin = 0;
//$addCooker = CookerDAO::insert($pdo, $newCooker, $newCookerPwd, $admin);
//if ($addCooker == 1) {
//    $pdo->commit();
//    echo $addCooker . ' Utilisateur à bien été enregisté.';
//} else {
//    echo 'Enregistrement de l\'utilisateur non réalisé.' . $addCooker;
//    $pdo->rollBack();
//}
//Test de la supression d'un utilisateur
//echo '<hr><br>SUPPRESSION D\'UN UTILISATEUR<br><hr>';
//$toDeleteIdCooker = 2;
//$deletedCooker = CookerDAO::delete($pdo, $toDeleteIdCooker);
//if ($deletedCooker == 1) {
//    $pdo->commit();
//    echo $deletedCooker .' utilisateur supprimé.';
//} else {
//    $pdo->rollBack();
//    echo 'La suppréssion à échoué.';
//}
//Test de la modification d'un utilisateur
//echo '<hr><br>Modifier un utilisateur<br><hr>';
//$idCooker = 3;
//$newCookerPseudo = 'romain';
//$newCookerPwd = 789;
//$updatedCookerPseudo = CookerDAO::update($pdo, $idCooker, $newCookerPseudo, $newCookerPwd);
//if ($updatedCookerPseudo == 1) {
//    $pdo->commit();
//    echo $updatedCookerPseudo . ' utilisateur modifié.';
//} else {
//    $pdo->rollBack();
//    echo 'Utilisateur non modifié.';
//}

echo '<br>test du hashage du mdp<br>';
$mdp = '123';
echo CookerDAO::passwordCrypter($mdp);

echo '<br>Test de la methode getPassword()<br>';
echo CookerDAO::getPassword($pdo, 'tata');

echo '<br>Test de la methode checkPassword()<br>';
$pseudo = "titi";
$mdp = '123';
var_dump(CookerDAO::checkPassword($pdo, $pseudo, $mdp));

//Deconnexion
Connexion::seDeconnecter($pdo);
