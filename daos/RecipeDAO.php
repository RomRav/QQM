<?php

/**
 * RecipeDAO.php
 * Bibliothéque d'accées au recettes
 * @author Romain
 * 26/02/2020
 * last update 04/03/2020
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
                $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], $raw['recipe'], $raw['recipe_visibility'], $raw['id_cooker'], $raw['photoFileName']);
                array_push($listRecipe, $recipe);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listRecipe;
    }

    /**
     * selectAllTitle()
     * @author Romain Ravault
     * 04/03/2020
     * @return Object Table
     */
    public static function selectAllTitle($pdo) {
        $listRecipeTitle = [];
        try {
            $requet = "SELECT id_recipe, recipe_title, photoFileName FROM recipe;";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], '', '', '', $raw['photoFileName']);
                array_push($listRecipeTitle, $recipe);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listRecipeTitle;
    }

    /**
     * selectByCooker()
     * @author Romain Ravault
     * 12/10/2020
     * @return type
     */
    public static function selectTitleByIdCooker(pdo $pdo, $idCooker) {
        $listRecipeTitle = [];
        try {
            $requet = "SELECT id_recipe, recipe_title, photoFileName FROM qqm.recipe WHERE id_cooker = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idCooker);
            $stmt->execute();
            $raws = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($raws as $raw) {
                $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], '', '', '', $raw['photoFileName']);
                array_push($listRecipeTitle, $recipe);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }

        return $listRecipeTitle;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 26/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, $idRecipe) {
        try {
            $requet = "SELECT * FROM qqm.recipe WHERE id_recipe = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idRecipe);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $recipe = new Recipe($raw['id_recipe'], $raw['recipe_title'], $raw['recipe'], $raw['recipe_visibility'], $raw['id_cooker'], $raw['photoFileName']);
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
    public static function insert(pdo $pdo, $newRecipeTitle, $newRecipe, $newRecipeVisibility, $newIdCooker, $photoFileName) {
        try {
            
//            echo '// titre: ' . $newRecipeTitle . '// recette: ' . $newRecipe . ' // ' . $newRecipeVisibility . ' // ' . $newIdCooker . ' // ' . $photoFileName;
            $request = "INSERT INTO qqm.recipe(recipe_title, recipe, recipe_visibility, id_cooker, photoFileName) VALUE(?,?,?,?,?);";
            $stmt = $pdo->prepare($request);
            
            $stmt->bindParam(1, $newRecipeTitle);
            $stmt->bindParam(2, $newRecipe);
            $stmt->bindParam(3, $newRecipeVisibility);
            $stmt->bindParam(4, $newIdCooker);
            $stmt->bindParam(5, $photoFileName);
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
    public static function delete(pdo $pdo, $idRecipe) {
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
    public static function update(pdo $pdo, $idRecipe, $newRecipeTitle, $newRecipe, $newRecipeVisibility, $newIdCooker, $photoFileName) {
        $request = 'UPDATE qqm.recipe SET recipe_title = ?, recipe = ?, recipe_visibility = ?, id_cooker = ?, photoFileName = ? WHERE id_recipe = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeTitle, PDO::PARAM_STR);
            $stmt->bindParam(2, $newRecipe, PDO::PARAM_STR);
            $stmt->bindParam(3, $newRecipeVisibility, PDO::PARAM_INT);
            $stmt->bindParam(4, $newIdCooker, PDO::PARAM_INT);
            $stmt->bindParam(6, $idRecipe, PDO::PARAM_INT);
            $stmt->bindParam(5, $photoFileName, PDO::PARAM_STR);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();         
        } catch (PDOException $ex) {
            printf("Code erreur: %s\n", $stmt->errorCode());
            list($code, $driverCode, $driverMessage) = $stmt->errorInfo();
            printf("Information : %s - %s - %s\n", $code, $driverCode, $driverMessage);
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

}
