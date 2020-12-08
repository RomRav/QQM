<?php

session_start();
/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 01/12/2020
 *
 * last update: 04/12/2020
 */
require_once '../ett/Cooker.php';
require_once '../daos/cookerDAO.php';
require_once '../daos/connexion.php';

$pdo = Connexion::seConnecter();
$message = "";
$cible = "authentificationIHM.php";

$isMdpSaved = filter_input(INPUT_POST, 'chkSavMdp');
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$typeOfForm = filter_input(INPUT_GET, 'type');

//Verification du choix de formulaire, login ou register
if ($typeOfForm == 'log') {
    $cooker = CookerDAO::selectOneByPseudoAndMdp($pdo, $pseudo, $password);
    if ($cooker != NULL) {
        $cible = 'recipeListIHM.php';
        $message = "ok";
        $_SESSION['cooker'] = $cooker;
    } else {
        $message = "Le pseudo ou mot de passe n'est pas reconnu!";
    }
} else {
    
    $message = "ok";
}


//Verification si le mot de passe doit être sauvegarder et crée un COOKIE en fonction
if ($isMdpSaved == "on") {
    setcookie('mdp', $password, time() + (3600 * 24 * 365), "/");
} else {
    setcookie('mdp', '', 1, "/");
    unset($_COOKIE['mdp']);
}


if ($message != "") {
    include '../boundaries/' . $cible;
}
