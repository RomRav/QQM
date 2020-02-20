<?php

/**
 * PaysDAO.php
 * Bibliothéque d'accées au données des pays
 * @author Romain
 * 20/02/2020
 * 
 * selectAll(): récupération de la liste de tous les pays
 * selectOne($id): récupération un pays
 * insert(): ajout d'un pays
 * update($id): modification d'un pays
 * delete($id): Supression d'un pays
 */
require_once 'Connexion.php';
require_once '../ett/Pays.php';

class PaysDAO {

    /**
     * selectAll()
     * @author Romain Ravault
     * 20/02/202
     * @return type
     */
    public static function selectAll() {
        $listCountry = [];
        try {
            $requet = "SELECT * FROM country";
            $pdo = Connexion::seConnecter("bd.ini");
            $raws = $pdo->query($requet);
            while ($raw = $raws->fetch()) {
                $country = new Pays($raw[0], $raw[1]);
                array_push($listCountry, $country);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listCountry;
    }

}
