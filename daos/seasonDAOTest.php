<?php

/*
 * Test des méthodes de la class seasonDAOTest
 * @authore: Romain Ravault
 * 24/02/2020
 * Last update 24/02/2020
 */

require_once 'SeasonDAO.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();

//Test da la récupération des saisons

echo '<br><hr>Listes des saisons<hr><br>';
$seasonTable = [];
$seasonTable = SeasonDAO::selectAll($pdo);
$season;
foreach ($seasonTable as $season) {
    echo $season. '<br><hr>';
}


echo SeasonDAO::selectSeasonOfARecepie($pdo, 21);