<?php

/**
 * SeasonDAO.php
 * Bibliothéque d'accées au données des saisons
 * @author Romain
 * 24/02/2020
 * Last update 24/02/2020
 * 
 * selectAll($pdo): récupération de la liste de tous les saisons
 */
class SeasonDAO {

    public static function selectAll(pdo $pdo) {
        $request = 'SELECT * FROM qqm.season;';
        $seasonTable = [];
        try {
            $stmt = $pdo->query($request);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $season) {
                array_push($seasonTable, $season['season_name']);
            }
        } catch (PDOException $ex) {
            echo 'Erreur:' . $ex->getMessage();
        }
        return $seasonTable;
    }

}
