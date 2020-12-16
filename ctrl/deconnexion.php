<?php

/*
 * deconnexion.php
 * Romain Ravault
 * 07/12/2020
 * Last update 16/12/2020
 */

if (isset($_SESSION['cooker'])) {
    $_SESSION = array();
    unset($_SESSION['admin']);
    unset($_SESSION['cooker']);
    unset($_SESSION['idCooker']);
    session_destroy();
    $message = 'Vous êtes déconnecté';
} else {
    $message = "Vous n'étes pas connecté";
}

include '../boundaries/authentificationIHM.php';

