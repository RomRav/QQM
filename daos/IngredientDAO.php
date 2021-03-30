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
                $ingredient = new Ingredient($raw['id_ingredient'], $raw['ingredient'], $raw['ingredient_calorie'], null, null);
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
     * 25/02/2020
     * @return type
     */
    public static function selectOne(pdo $pdo, $idIngredient) {
        try {
            $requet = "SELECT * FROM qqm.ingredient WHERE id_ingredient = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idIngredient);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $ingredient = new Ingredient($raw['id_ingredient'], $raw['ingredient'], $raw['ingredient_calorie'], null, null);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $ingredient;
    }

    /**
     * selectOneByName()
     * @author Romain Ravault
     * 22/09/2020
     * @return type
     */
    public static function selectOneByName(pdo $pdo, $ingredientName) {
        try {
            $requet = "SELECT * FROM qqm.ingredient WHERE ingredient = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $ingredientName);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $ingredient = new Ingredient($raw['id_ingredient'], $raw['ingredient'], $raw['ingredient_calorie'], null, null);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $ingredient;
    }

    /**
     * selectOnePlus()
     * @author Romain Ravault
     * 25/09/202
     * Last update 28/09/2020
     * @return type
     */
    public static function selectOnePlus(pdo $pdo, $idRecipe) {
        $listIngredients = [];
        try {
            $requet = "SELECT * FROM qqm.a_recipe 
                INNER JOIN ingredient ON a_recipe.id_ingredient = ingredient.id_ingredient
                INNER JOIN unite_of_measure ON a_recipe.id_UOM = unite_of_measure.id_uom
                WHERE a_recipe.id_recipe = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($ingredient = $stmt->fetch()) {
                $ingredientObj = new Ingredient($ingredient['id_ingredient'], $ingredient['ingredient'], $ingredient['ingredient_calorie'], $ingredient['qty'], $ingredient['uom']);
                $listIngredients[] = $ingredientObj;
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listIngredients;
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
