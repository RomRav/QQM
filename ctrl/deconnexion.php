<?php

session_start();
/*
 * deconnexion.php
 * Romain Ravault
 * 07/12/2020
 * Last update 24/03/2021
 */

if (isset($_SESSION['pseudo']) || isset($_COOKIE['pseudo'])) {
    unset($_SESSION);
    setcookie('pseudo', '', time(), "/");
    setcookie('idCooker', '', time(), "/");
    unset($_COOKIE['pseudo']);
    unset($_COOKIE['idCooker']);
    session_destroy();
    $message = 'Vous êtes déconnecté';
} else {
    $message = "Vous n'étes pas connecté";
}


header('location:routeur.php?route=authentification');

