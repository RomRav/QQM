<?php

/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 01/12/2020
 *
 * last update: 01/12/2020
 */
require_once '../ett/Cooker.php';
$message = "";

$pseudo = filter_input(INPUT_GET, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

echo 'pseudo  '. $pseudo.'  mot de passe  '.$password;