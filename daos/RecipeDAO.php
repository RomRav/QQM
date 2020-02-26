<?php

/**
 * RecipeDAO.php
 * Bibliothéque d'accées au recettes
 * @author Romain
 * 26/02/2020
 *  
 * selectAll($pdo): récupération de toutes les recettes 
 * selectOne($pdo, $id): récupération d'une recette
 * insert(): ajout d'un utilisateur
 * update($id): modification d'une recette
 * delete($id): Supression d'une recette
 */
require_once 'Connexion.php';
require_once '../ett/Recipe.php';

class RecipeDAO {

    /**
     * selectAll()
     * @author Romain Ravault
     * 26/02/202
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listRecipe = [];
        try {
            $requet = "SELECT * FROM recipe;";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], $raw['recipe'], $raw['recipe_visibility'], $raw['id_cooker']);
                array_push($listRecipe, $recipe);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listRecipe;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 26/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, int $idRecipe) {
        try {
            $requet = "SELECT * FROM qqm.recipe WHERE id_recipe = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], $raw['recipe'], $raw['recipe_visibility'], $raw['id_cooker']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $recipe;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 26/02/2020
     * @param pdo $pdo
     * @param string $newRecipeTitle
     * @param string $newRecipe
     * @param string $newRecipeVisibility
     * @param string $newIdCooker
     * @return type
     */
    public static function insert(pdo $pdo, string $newRecipeTitle, string $newRecipe, int $newRecipeVisibility, int $newIdCooker) {
        try {
            $request = "INSERT INTO qqm.recipe(recipe_title, recipe, recipe_visibility, id_cooker) VALUE(?,?,?,?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeTitle);
            $stmt->bindParam(2, $newRecipe);
            $stmt->bindParam(3, $newRecipeVisibility);
            $stmt->bindParam(4, $newIdCooker);
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
     * 26/02/2020
     * 
     * @param pdo $pdo
     * @param int $idRecipe   
     * @return type
     */
    public static function delete(pdo $pdo, int $idRecipe) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.recipe WHERE id_recipe = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idRecipe);
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
     * 26/02/2020
     * 
     * @param pdo $pdo
     * @param int $idRecipe
     * @param string $newRecipeTitle
     * @param string $newRecipe
     * @param string $newRecipeVisibility
     * @param int $newIdCooker
     * @return type
     */
    public static function update(pdo $pdo, int $idRecipe, string $newRecipeTitle, string $newRecipe, string $newRecipeVisibility, int $newIdCooker) {
        $request = 'UPDATE qqm.recipe SET recipe_title = ?, recipe = ?, recipe_visibility = ?, id_cooker = ? WHERE id_recipe = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeTitle);
            $stmt->bindParam(2, $newRecipe);
            $stmt->bindParam(3, $newRecipeVisibility);
            $stmt->bindParam(4, $newIdCooker);
            $stmt->bindParam(5, $idRecipe);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

}
