<?php

/**
 * PositionDAO.php
 * Bibliothéque d'accées aux données des positions de plat
 * @author Romain
 * 27/02/2020
 * Last update 30/03/2021
 * 
 * selectAll($pdo): récupération de la liste de tous les positions
 * insert($pdo): ajout d'une nouvelle position
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

    /**
     * insert()
     * @author Romain Ravault
     * 16/12/2020
     * @param pdo $pdo
     * @param string $newPosition
     * @return insertVerif
     */
    public static function insert(pdo $pdo, $newPosition) {
        $request = 'INSERT INTO qqm.position_in_meal(position) VALUE (?);';
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newPosition);
            $stmt->execute();
            $insertVerif = $stmt->rowCount();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $insertVerif = -1;
        }
        return $insertVerif;
    }

    /**
     * update()
     * @author Romain Ravault
     * 16/12/2020
     * @param pdo $pdo
     * @param string $position
     * @param string $newPosition
     * @return int Vérification de la mise à jour
     */
    public static function update(pdo $pdo, $position, $newPosition) {
        $request = "UPDATE position_in_meal SET position = ? WHERE position = ?;";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newPosition);
            $stmt->bindParam(2, $position);
            $stmt->execute();
            $updateVerif = $stmt->rowCount();
            echo $updateVerif;
        } catch (Exception $ex) {
           echo $ex->getMessage();
            $updateVerif = -1;
        }
        return $updateVerif;
    }

    /**
     * delete()
     * @author Romain Ravault
     * 16/12/2020
     * @param pdo $pdo
     * @param string $position
     * @return int Verification de la suppression
     */
    public static function delete(pdo $pdo, $position) {
        $reqest = 'DELETE FROM qqm.position_in_meal WHERE position = ?;';
        try {
            $stmt = $pdo->prepare($reqest);
            $stmt->bindParam(1, $position);
            $stmt->execute();
            $deleteVerif = $stmt->rowCount();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $deleteVerif = -1;
        }
        return $deleteVerif;
    }
    
    /**
     * selectPositionOfARecepie()
     * @author Romain Ravault
     * 30/03/2021
     * @param PDO $pdo
     * @param type $idRecipe
     * @return type
     */
    public static function selectPositionOfARecepie(PDO $pdo, $idRecipe) {
        try {
            $requet = "SELECT position from qqm.the_recipe_meal_position "
                    . "WHERE the_recipe_meal_position.id_recipe = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $position = $raw['position'];
        } catch (Exception $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $position;
    }

}
