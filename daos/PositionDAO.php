<?php

/**
 * PositionDAO.php
 * Bibliothéque d'accées au données des positions de plat
 * @author Romain
 * 27/02/2020
 * Last update 27/02/2020
 * 
 * selectAll($pdo): récupération de la liste de tous les positions
 */
class PositionDAO {

    public static function selectAll(pdo $pdo) {
        $request = 'SELECT * FROM qqm.position_in_meal;';
        $positionTable = [];
        try {
            $stmt = $pdo->query($request);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt as $position) {
                array_push($positionTable, $position['position']);
            }
        } catch (PDOException $ex) {
            echo 'Erreur:' . $ex->getMessage();
        }
        return $positionTable;
    }

}
