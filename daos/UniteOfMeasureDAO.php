<?php

/*
 * UniteOfMeasureDAO.php
 * Bibliothéque d'accées au données des unités de mesure
 * @author Romain
 * 23/09/2020
 * 
 * 
 * selectAll($pdo): récupération de la liste de tous les unités de mesure
 * selectOne($pdo, $id): récupération une unité de mesure 
 * insert(): ajout d'une unité de mesure
 * update($id): modification d'une unité de mesure
 * delete($id): Supression d'une unité de mesure
 */


require_once 'Connexion.php';
require_once '../ett/UniteOfMeasure.php';

class UniteOfMeasureDAO {

    /**
     * selectAll()
     * @author Romain Ravault
     * 23/09/202
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listUOM = [];
        try {
            $requet = "SELECT * FROM unite_of_measure";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $uom = new UniteOfMeasure($raw['id_UOM'], $raw['uom']);
                array_push($listUOM, $uom);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listUOM;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 23/09/202
     * @return type
     */
    public static function selectOne(pdo $pdo, int $idUom) {
        try {
            $requet = "SELECT * FROM unite_of_measure WHERE id_UOM = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idUom);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $uom = new UniteOfMeasure($raw['id_UOM'], $raw['uom']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $uom;
    }

    /**
     * selectOneByName()
     * @author Romain Ravault
     * 23/09/202
     * @return type
     */
    public static function selectOneByName(pdo $pdo, string $nameUom) {
        try {
            $requet = "SELECT * FROM unite_of_measure WHERE uom = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $nameUom);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $uom = new UniteOfMeasure($raw['id_UOM'], $raw['uom']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $uom;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 23/09/2020
     * @param pdo $pdo
     * @param string $newUom
     * @return type
     */
    public static function insert(pdo $pdo, string $newUom) {
        try {
            $request = "INSERT INTO qqm.unite_of_measure(uom) VALUE(?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newUom);
            $stmt->execute();
            $insertVerif = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $insertVerif = -1;
        }
        return $insertVerif;
    }

    /**
     * delete()
     * @author Romain Ravault
     * 23/09/2020
     * @param pdo $pdo
     * @param int $idUom
     * @return type
     */
    public static function delete(pdo $pdo, int $idUom) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.unite_of_measure WHERE id_UOM = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idUom);
            $stmt->execute();
            $liDelete = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liDelete = -1;
        }
        return$liDelete;
    }

    /**
     * update()
     * @author Romain Ravault
     * 23/09/2020
     * @param pdo $pdo
     * @param int $idUom
     * @param string $newUomName
     * @return type
     */
    public static function update(pdo $pdo, int $idUom, string $newUomName) {
        $request = 'UPDATE qqm.unite_of_measure SET uom = ? WHERE id_UOM = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newUomName);
            $stmt->bindParam(2, $idUom);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

}
