<?php

/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 01/12/2020
 *
 * last update: 01/12/2020
 */
require_once '../ett/Cooker.php';
require_once '../daos/cookerDAO.php';
require_once '../daos/connexion.php';

$pdo = Connexion::seConnecter();
$message = "";
$cible="authentificationIHM.php";

$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);


$cooker = CookerDAO::selectOneByPseudo($pdo, $pseudo, $password);
if($cooker->getPseudo()!=NULL){
    $cible='recipeListIHM.php';
    $message="ok";
} else {
    $message = "Le pseudo ou mot de passe n'est pas reconnu!";
}

if ($message != "") {
    include '../boundaries/'.$cible;
}