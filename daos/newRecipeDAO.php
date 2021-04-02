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
    public static function insertLinksOfNewRecipe(pdo $pdo, $newRecipeId, $newRecipe) {
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

    public static function updateLinkOfRecipe(PDO $pdo, $recipeIdToUpdate, $recipeToUpdate) {
        $request = "";
        $ingredientsTabUpdate = $recipeToUpdate->getIngredient();
        foreach ($ingredientsTabUpdate as $ingredientToUpdate) {
            echo $recipeIdToUpdate . " " . $ingredientIdToUpdate;
            $ingredientIdToUpdate = $ingredientToUpdate->getIdIngredient();
            $ingredientQtyToUpdate = $ingredientToUpdate->getqty();
            $ingredientUomToUpdate = $ingredientToUpdate->getIdUOM();
            $request .= "UPDATE qqm.a_recipe SET "
                    . "id_recipe=" . $recipeIdToUpdate . ", "
                    . "id_ingredient=" . $ingredientIdToUpdate . " , "
                    . "qty=" . $ingredientQtyToUpdate . ", "
                    . "id_UOM=" . $ingredientUomToUpdate . " "
                    . "WHERE id_recipe = " . $recipeIdToUpdate . " AND "
                    . "id_ingredient=" . $ingredientIdToUpdate . " ;";
        }
        $request .= "UPDATE the_recipe_country SET id_country= ? WHERE id_recipe= ?;";
        $request .= "UPDATE the_recipe_meal_position SET position= ? WHERE id_recipe= ?;";
        $request .= "UPDATE the_recipe_season SET season_name= ? WHERE id_recipe= ?;";
        $request .= "UPDATE the_recipe_type SET id_type= ? WHERE id_recipe= ?;";
        $numRec;
        try {
            $updateRecipeIngredient = $recipeToUpdate->getIngredient();
            $updateRecipeCountry = $recipeToUpdate->getCountry();
            $updateRecipePosition = $recipeToUpdate->getPosition();
            $updateRecipeContent = $recipeToUpdate->getContent();
            $updateRecipeSeason = $recipeToUpdate->getSeason();
            $updateRecipeContent = $recipeToUpdate->getContent();
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $updateRecipeCountry, PDO::PARAM_INT);
            $stmt->bindParam(2, $recipeIdToUpdate, PDO::PARAM_INT);
            $stmt->bindParam(3, $updateRecipePosition, PDO::PARAM_STR);
            $stmt->bindParam(4, $recipeIdToUpdate, PDO::PARAM_INT);
            $stmt->bindParam(5, $updateRecipeSeason, PDO::PARAM_STR);
            $stmt->bindParam(6, $recipeIdToUpdate, PDO::PARAM_INT);
            $stmt->bindParam(7, $updateRecipeContent, PDO::PARAM_INT);
            $stmt->bindParam(8, $recipeIdToUpdate, PDO::PARAM_INT);
            $stmt->execute();
            var_dump($stmt);
            $numRec = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo 'Erreur newRecipeDAO updateLinkOfRecipe '.$ex->getMessage();
        }
        return $numRec;
    }

}
