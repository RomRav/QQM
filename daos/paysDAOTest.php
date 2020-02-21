<?php

/*
 * Test des méthodes de la class paysDAOTest
 * @authore: Romain Ravault
 * 20/02/2020
 */

require_once 'PaysDAO.php';
require_once '../ett/Pays.php';
require_once 'Connexion.php';

//Connexion à la BD
$pdo = Connexion::seConnecter("bd.ini");
$pdo->beginTransaction();


//Test de la selection de tous les pays
$country = PaysDAO::selectAll($pdo);
echo '<hr><br>SELECT ALL<br><hr>';
foreach ($country as $raw) {
    //var_dump($raw);
    //$enr = new Pays($raw[0], $raw[1]);
    echo 'id pays: ' . $raw->getIdPays() . '  //***\\ nom du pays: ' . $raw->getPays() . '.<br>';
}

//Test de la selection d'un pays
echo '<hr><br>SELECT UNE PAYS PAR SON ID<br><hr>';
$idPays = 1;
$country = PaysDAO::selectOne($pdo, $idPays);
echo 'id pays: ' . $country->getIdPays() . '  //***\\ nom du pays: ' . $country->getPays() . '.<br>';



//Test de l'ajout d'un nouveau pays
echo '<hr><br>AJOUTER UN PAYS<br><hr>';
$newCountry = 'aa';

$addCountry = PaysDAO::insert($pdo, $newCountry);
if ($addCountry == 1) {
    $pdo->commit();
    echo $addCountry . ' pays à bien été enregisté.';
} else {
    echo 'Enregistrement du pays non réalisé.' . $addCountry;
    $pdo->rollBack();
}

Connexion::seDeconnecter($pdo);
