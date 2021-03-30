<?php

/**
 * TypeDAO.php
 * Bibliothéque d'accées au données des type de plat
 * @author Romain
 * 24/02/2020
 * Last update 25/02/2020
 * 
 * selectAll($pdo): récupération de la liste de tous les type de plat
 * selectOne($pdo, $id): récupération un type de plat
 * insert(): ajout d'un type de plat
 * update($id): modification d'un type de plat
 * delete($id): Supression d'un type de plat
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
    public static function selectOne(pdo $pdo, $idType) {
        try {
            $requet = "SELECT * FROM type_of_dish WHERE id_type = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idType);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $type = new Type($raw['id_type'], $raw['type_name']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $type;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 24/02/2020
     * Last update: 25/02/2020
     * @param pdo $pdo
     * @param string $newType
     * @return type
     */
    public static function insert(pdo $pdo, $newType) {
        try {
            $request = "INSERT INTO qqm.type_of_dish(type_name) VALUE(?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newType);
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
     * Last update: 25/02/2020
     * @param pdo $pdo
     * @param int $idType   
     * @return type
     */
    public static function delete(pdo $pdo, $idType) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.type_of_dish WHERE id_type = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idType);
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
     * Last update: 25/02/2020
     * @param pdo $pdo
     * @param int $idType
     * @param string $newTypeName
     * @return type
     */
    public static function update(pdo $pdo, $idType, $newTypeName) {
        $request = 'UPDATE qqm.type_of_dish SET type_name = ? WHERE id_type = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newTypeName);
            $stmt->bindParam(2, $idType);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

    public static function selectTypeOfARecepie(PDO $pdo, $idRecipe) {
        try {
            $requet = "SELECT * from qqm.the_recipe_type "
                    . "INNER Join type_of_dish On the_recipe_type.id_type = type_of_dish.id_type "
                    . "WHERE the_recipe_type.id_recipe = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $type = new Type($raw['id_type'], $raw['type_name']);
        } catch (Exception $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $type;
    }

}
