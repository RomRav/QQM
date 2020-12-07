<?php

/*
 * deconnexion.php
 * Romain Ravault
 * 07/12/2020
 */
session_start();
$cooker = $_SESSION['cooker'];

if (isset($cooker)) {
    unset($_SESSION['cooker']);
    $message = 'Vous êtes déconnecté';
} else {
    $message = "Vous n'étes pas connecté";
}

include '../boundaries/authentificationIHM.php';

