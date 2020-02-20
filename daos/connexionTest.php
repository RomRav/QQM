<?php

/*
 * Test de connexion à la bd
 * @author: Romain Ravault
 * 20/02/2020
 */

require_once 'Connexion.php';

$pdo = Connexion::seConnecter("bd.ini");

echo "<br><pre>";
var_dump($pdo);
echo "</pre><br>";

Connexion::seDeconnecter($pdo);

