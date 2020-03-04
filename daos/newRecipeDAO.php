<?php

/**
 * Class newRecipeDAO bibliotheque de gestion des liens entre les tables
 *
 * @author Romain Ravault
 * 29/02/2020
 *  Last update 03/03/2020
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
        $newRecipeIngredient = $newRecipe->getIngredient();
        $newRecipeCountry = $newRecipe->getCountry();
        $newRecipePosition = $newRecipe->getPosition();
        $newRecipeContent = $newRecipe->getContent();
        $newRecipeSeason = $newRecipe->getSeason();
        try {
            echo $newRecipeSeason;
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeId);
            $stmt->bindParam(2, $newRecipeIngredient);
            $stmt->bindParam(3, $newRecipeId);
            $stmt->bindParam(4, $newRecipeCountry);
            $stmt->bindParam(5, $newRecipeId);
            $stmt->bindParam(6, $newRecipePosition);
            $stmt->bindParam(7, $newRecipeId);
            $stmt->bindParam(8, $newRecipeSeason);
            $stmt->bindParam(9, $newRecipeId);
            $stmt->bindParam(10, $newRecipeContent);
            $stmt->execute();
            $numRec = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return$numRec;
    }

}
