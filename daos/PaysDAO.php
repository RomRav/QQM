<?php

/**
 * PaysDAO.php
 * Bibliothéque d'accées au données des pays
 * @author Romain
 * 20/02/2020
 * Last update 24/02/2020
 * 
 * selectAll($pdo): récupération de la liste de tous les pays
 * selectOne($pdo, $id): récupération un pays
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
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listCountry = [];
        try {
            $requet = "SELECT * FROM country";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $country = new Pays($raw['id_country'], $raw['country_name']);
                array_push($listCountry, $country);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listCountry;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 21/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, $idPays) {
        try {
            $requet = "SELECT * FROM country WHERE id_country = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idPays);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $country = new Pays($raw['id_country'], $raw['country_name']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $country;
    }

    /**
     * selectCountryOfARecipe()
     * @author Romain Ravault
     * 30/03/2021
     * 
     * @param PDO $pdo
     * @param type $idRecipe
     * @return \Pays
     */
    public static function selectCountryOfARecepie(PDO $pdo, $idRecipe) {
        try {
            $requet = "SELECT * from qqm.the_recipe_country "
                    . "INNER Join country On the_recipe_country.id_country = country.id_country "
                    . "WHERE the_recipe_country.id_recipe = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $country = new Pays($raw['id_country'], $raw['country_name']);
        } catch (Exception $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $country;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 21/02/2020
     * @param pdo $pdo
     * @param string $newCountry
     * @return type
     */
    public static function insert(pdo $pdo, $newCountry) {
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
    public static function delete(pdo $pdo, $idPay) {
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
    public static function update(pdo $pdo, $idPays, $newCountryName) {
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
