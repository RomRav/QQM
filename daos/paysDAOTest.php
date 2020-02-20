<?php

/*
 * Test des méthodes de la class paysDAOTest
 * @authore: Romain Ravault
 * 20/02/2020
 */

require_once 'PaysDAO.php';
require_once '../ett/Pays.php';


//Test de la selection de tous les pays
$country = PaysDAO::selectAll();

foreach ($country as $raw) {
    //var_dump($raw);
    //$enr = new Pays($raw[0], $raw[1]);
    echo 'id pays: ' . $raw->getIdPays() . ' nom du pays: ' . $raw->getPays() . '.<br>';
}

