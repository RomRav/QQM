<?php

/**
 * SeasonDAO.php
 * Bibliothéque d'accées au données des saisons
 * @author Romain
 * 24/02/2020
 * Last update 30/03/2021
 * 
 * selectAll($pdo): récupération de la liste de tous les saisons
 */
class SeasonDAO {
    /**
     * selectAll()
     * @author Romain Ravault
     * 
     * @param pdo $pdo
     * @return array
     */
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
    
    
    
    public static function selectSeasonOfARecepie(PDO $pdo, $idRecipe) {
        try {
            $requet = "SELECT season_name from qqm.the_recipe_season "
                    . "WHERE the_recipe_season.id_recipe = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $season = $raw['season_name'];
        } catch (Exception $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $season;
    }

}
