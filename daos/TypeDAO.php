<?php

/**
 * TypeDAO.php
 * Bibliothéque d'accées au données des type de plats
 * @author Romain
 * 24/02/2020
 * Last update 24/02/2020
 * 
 * selectAll($pdo): récupération de la liste de tous les type de plats
 * selectOne($pdo, $id): récupération un pays
 * insert(): ajout d'un pays
 * update($id): modification d'un pays
 * delete($id): Supression d'un pays
 */
require_once 'Connexion.php';
require_once '../ett/Type.php';

class TypeDAO {
    /**
     * selectAll()
     * @author Romain Ravault
     * 24/02/202
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listType = [];
        try {
            $requet = "SELECT * FROM type_of_dish;";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $type = new Type($raw['id_type'], $raw['type_name']);
                array_push($listType, $type);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listType;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 24/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, int $idPays) {
        try {
            $requet = "SELECT * FROM type_of_dish WHERE id_type = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idPays);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $country = new Type($raw['id_type'], $raw['type_name']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $country;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 24/02/2020
     * @param pdo $pdo
     * @param string $newCountry
     * @return type
     */
    public static function insert(pdo $pdo, string $newCountry) {
        try {
            $request = "INSERT INTO qqm.country(country_name) VALUE(?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCountry);
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
     * 24/02/2020
     * @param pdo $pdo
     * @param int $idPay
     * @return type
     */
    public static function delete(pdo $pdo, int $idPay) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.country WHERE id_country = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idPay);
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
     * 24/02/2020
     * @param pdo $pdo
     * @param int $idPays
     * @param string $newCountryName
     * @return type
     */
    public static function update(pdo $pdo, int $idPays, string $newCountryName) {
        $request = 'UPDATE qqm.country SET country_name = ? WHERE id_country = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCountryName);
            $stmt->bindParam(2, $idPays);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }
}
