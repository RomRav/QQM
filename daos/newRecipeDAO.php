<?php

/**
 * Class newRecipeDAO bibliotheque de gestion des liens entre les tables
 *
 * @author Romain Ravault
 * 29/02/2020
 *  Last update 03/03/2020
 */
class NewRecipeDAO {

    /**
     * insertLinksOfNewRecipe function
     * @param pdo $pdo
     * @param int $newRecipeId
     * @param object $newRecipe
     * @return type
     */
    public static function insertLinksOfNewRecipe(pdo $pdo, int $newRecipeId, object $newRecipe) {

        //Enregistement dans la BD du lien entre les ingrédients et la recette
        $request = "";

        $ingredientsTab = $newRecipe->getIngredient();
        foreach ($ingredientsTab as $ingredient) {
            $ingredientId = $ingredient["id"];
            $ingredientQty = $ingredient["qty"];
            $ingredientUom = $ingredient["uom"];
            $request .= "INSERT INTO qqm.a_recipe (id_recipe, id_ingredient, qty, id_UOM) VALUES ($newRecipeId, $ingredientId, $ingredientQty, $ingredientUom);";
        }
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
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newRecipeId);
            $stmt->bindParam(2, $newRecipeCountry);
            $stmt->bindParam(3, $newRecipeId);
            $stmt->bindParam(4, $newRecipePosition);
            $stmt->bindParam(5, $newRecipeId);
            $stmt->bindParam(6, $newRecipeSeason);
            $stmt->bindParam(7, $newRecipeId);
            $stmt->bindParam(8, $newRecipeContent);
            $stmt->execute();
            $numRec = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return$numRec;
    }

}
