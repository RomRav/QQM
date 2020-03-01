<?php

/**
 * Class newRecipeDAO bibliotheque de gestion des liens entre les tables
 *
 * @author Romain Ravault
 * 29/02/2020
 */
class newRecipeDAO {
/**
 * insertLinksOfNewRecipe function
 * @param pdo $pdo
 * @param int $newRecipeId
 * @param object $newRecipe
 * @return type
 */
    public static function insertLinksOfNewRecipe(pdo $pdo, int $newRecipeId, object $newRecipe) {
        $request = "";
        $numRec;
        try {
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return$numRec;
    }

}
