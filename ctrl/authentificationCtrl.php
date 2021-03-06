<?php
session_start();
/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 01/12/2020
 *
 * last update: 25/03/2021
 */
require_once '../ett/Cooker.php';
require_once '../daos/cookerDAO.php';
require_once '../daos/connexion.php';

$pdo = Connexion::seConnecter();
$pdo->beginTransaction();
$message = "";
$cible = "authentification";

$isMdpSaved = filter_input(INPUT_POST, 'chkSavMdp');
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$passwordCheck = filter_input(INPUT_POST, 'pwdCheckInput', FILTER_SANITIZE_SPECIAL_CHARS);
$typeOfForm = filter_input(INPUT_GET, 'type');
//Verification du choix de formulaire, login ou register
if ($typeOfForm == 'log') {
//    if (CookerDAO::checkPassword($pdo, $pseudo, $mdp)) {
        $cooker = CookerDAO::selectOneByPseudo($pdo, $pseudo);
        if ($cooker != NULL) {
            $message = "ok";
            $_SESSION['pseudo'] = $cooker->getPseudo();
            $_SESSION['idCooker'] = $cooker->getIdCooker();
            $_SESSION['admin'] = $cooker->getAdmin();
            $cible = 'recipeList';
//        }
    } else {
        $message = "Le pseudo ou mot de passe n'est pas reconnu!";
    }
} else if ($typeOfForm == 'id') {
    $newUserInsertCheck = CookerDAO::insert($pdo, $pseudo, $password, 0);
    if ($newUserInsertCheck == 1) {
        $pdo->commit();
        $cible = 'recipeList';
        $message = 'ok';
    } else {
        $message = 'Erreur de création de compte.';
        $cible = "authentification";
    }
}
//Verification si le mot de passe doit être sauvegarder et crée un COOKIE en fonction
if ($isMdpSaved == "on") {
    setcookie('pseudo', $pseudo, time() + (3600 * 24 * 365), "/");
    setcookie('idCooker', $_SESSION['idCooker'], time() + (3600 * 24 * 365), "/");
} else {
    setcookie('pseudo', '', time(), "/");
    setcookie('idCooker', '', time(), "/");
    unset($_COOKIE['pseudo']);
    unset($_COOKIE['idCooker']);
}
if ($message != "") {
    header("location:../ctrl/routeur.php?route=" . $cible."&message=".$message);
}
