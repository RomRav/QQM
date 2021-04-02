<?php

session_start();
/**
 * authentificationCtrl.php
 * @authore : Romain Ravault
 * 02/04/2021
 *
 * last update
 */
echo 'AAAAAAAAAAAAAAA';
$newPseudoInput = filter_input(INPUT_POST, "newPseudoInput", FILTER_SANITIZE_SPECIAL_CHARS);
echo $newPseudoInput;
