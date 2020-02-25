<?php

/**
 * IngredientDAO.php
 * Bibliothéque d'accées au données des ingredients
 * @author Romain
 * 25/02/2020
 *  
 * selectAll($pdo): récupération de la liste de tous les ingredients
 * selectOne($pdo, $id): récupération un ingredient
 * insert(): ajout d'un ingredient
 * update($id): modification d'un ingredient
 * delete($id): Supression d'un ingredient
 */
require_once 'Connexion.php';
require_once '../ett/Ingredient.php';

class IngredientDAO {

    /**
     * selectAll()
     * @author Romain Ravault
     * 25/02/202
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listIngredient = [];
        try {
            $requet = "SELECT * FROM ingredient;";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $ingredient = new Ingredient($raw['id_ingredient'], $raw['ingredient'], $raw['ingredient_calorie']);
                array_push($listIngredient, $ingredient);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listIngredient;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 25/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, int $idIngredient) {
        try {
            $requet = "SELECT * FROM qqm.ingredient WHERE id_ingredient = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idIngredient);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $ingredient = new Ingredient($raw['id_ingredient'], $raw['ingredient'], $raw['ingredient_calorie']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $ingredient;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 25/02/2020
     * @param pdo $pdo
     * @param string $newType
     * @param string $ingredientCalorie
     * @return type
     */
    public static function insert(pdo $pdo, string $newIngredient, string $ingredientCalorie) {
        try {
            $request = "INSERT INTO qqm.ingredient(ingredient, ingredient_calorie) VALUE(?,?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newIngredient);
            $stmt->bindParam(2, $ingredientCalorie);
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
     * 25/02/2020
     * 
     * @param pdo $pdo
     * @param int $idType   
     * @return type
     */
    public static function delete(pdo $pdo, int $idIngredient) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.ingredient WHERE id_ingredient = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idIngredient);
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
     * 25/02/2020
     * 
     * @param pdo $pdo
     * @param int $idType
     * @param string $newTypeName
     * @return type
     */
    public static function update(pdo $pdo, int $idIngredient, string $newIngredient, string $newIngredientCalorie) {
        $request = 'UPDATE qqm.ingredient SET ingredient = ?, ingredient_calorie = ? WHERE id_ingredient = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newIngredient);
            $stmt->bindParam(2, $newIngredientCalorie);
            $stmt->bindParam(3, $idIngredient);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

}
