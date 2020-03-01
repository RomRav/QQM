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
        $request = "INSERT INTO qqm.a_recipe (id_recipe, id_ingredient) VALUES (?, ?);";
        $request .= "INSERT INTO qqm.the_recipe_country(id_recipe, id_country) VALUES (?, ?);";
        $request .= "INSERT INTO qqm.the_recipe_meal_position(id_recipe, position) VALUES (?, ?);";
        $request .= "INSERT INTO qqm.the_recipe_season(id_recipe, season_name) VALUES (?, ?);";
        $request .= "INSERT INTO qqm.the_recipe_type(id_recipe, id_type) VALUES (?, ?);";
        $numRec;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeId);
            $stmt->bindParam(2, $newRecipe->GetIngredient());
            $stmt->bindParam(3, $newRecipeId);
            $stmt->bindParam(4, $newRecipe->GetCountry());
            $stmt->bindParam(5, $newRecipeId);
            $stmt->bindParam(6, $newRecipe->GetPosition());
            $stmt->bindParam(7, $newRecipeId);
            $stmt->bindParam(8, $newRecipe->GetContent());
            $stmt->bindParam(9, $newRecipeId);
            $stmt->bindParam(10, $newRecipeId);
            $numRec = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return$numRec;
    }

}
