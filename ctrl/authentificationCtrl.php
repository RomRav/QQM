<?php

session_start();
/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 01/12/2020
 *
 * last update: 18/12/2020
 */
require_once '../ett/Cooker.php';
require_once '../daos/cookerDAO.php';
require_once '../daos/connexion.php';

$pdo = Connexion::seConnecter();
$pdo->beginTransaction();
$message = "";
$cible = "authentificationIHM.php";

$isMdpSaved = filter_input(INPUT_POST, 'chkSavMdp');
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$passwordCheck = filter_input(INPUT_POST, 'pwdCheckInput', FILTER_SANITIZE_SPECIAL_CHARS);
$typeOfForm = filter_input(INPUT_GET, 'type');

//Verification du choix de formulaire, login ou register
if ($typeOfForm == 'log') {
    $cooker = CookerDAO::selectOneByPseudoAndMdp($pdo, $pseudo, $password);
    if ($cooker != NULL) {
        $message = "ok";
        $_SESSION['cooker'] = $cooker->getPseudo();
        $_SESSION['idCooker'] = $cooker->getIdCooker();
        $_SESSION['admin'] = $cooker->getAdmin();
        $cible = 'recipeListIHM.php';
    } else {
        $message = "Le pseudo ou mot de passe n'est pas reconnu!";
    }
} else if ($typeOfForm == 'id'){
    $newUserInsertCheck = CookerDAO::insert($pdo, $pseudo, $password);
    if ($newUserInsertCheck == 1) {
        $pdo->commit();
        $cible = 'recipeListIHM.php';
        $message = 'ok';
    } else {
        $message = 'Erreur de création de compte.';
        $cible = "authentificationIHM.php";
    }
}
//Verification si le mot de passe doit être sauvegarder et crée un COOKIE en fonction
if ($isMdpSaved == "on") {
    setcookie('mdp', $password, time() + (3600 * 24 * 365), "/");
} else {
    setcookie('mdp', '', 1, "/");
    unset($_COOKIE['mdp']);
}
if ($message != "") {
    include "../boundaries/" . $cible;
}
