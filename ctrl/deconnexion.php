<?php

session_start();
/*
 * deconnexion.php
 * Romain Ravault
 * 07/12/2020
 * Last update 16/12/2020
 */

if (isset($_SESSION['cooker'])) {
    session_destroy();
    $_SESSION = array();
    unset($_SESSION['admin']);
    unset($_SESSION['cooker']);
    unset($_SESSION['idCooker']);

    $message = 'Vous êtes déconnecté';
} else {
    $message = "Vous n'étes pas connecté";
}

include '../boundaries/authentificationIHM.php';

