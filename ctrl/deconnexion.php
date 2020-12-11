<?php
/*
 * deconnexion.php
 * Romain Ravault
 * 07/12/2020
 * Last update 08/12/2020
 */
session_start();
if (isset($_SESSION['cooker'])) {
    $_SESSION['cooker'] = "";
    $_SESSION['idCooker'] = "";
    unset($_SESSION['cooker']);
    unset($_SESSION['idCooker']);
    $message = 'Vous êtes déconnecté';
} else {
    $message = "Vous n'étes pas connecté";
}

include '../boundaries/authentificationIHM.php';

