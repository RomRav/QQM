<?php

/*
 * Test des méthodes de la class positionDAOTest
 * @authore: Romain Ravault
 * 27/02/2020
 * Last update 27/02/2020
 */

require_once 'PositionDAO.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();

//Test da la récupération des positions

echo '<br><hr>Listes des positions<hr><br>';
$positionTable = [];
$positionTable = PositionDAO::selectAll($pdo);
$position;
foreach ($positionTable as $position) {
    echo $position . '<br><hr>';
}