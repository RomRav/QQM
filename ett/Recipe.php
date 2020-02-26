<?php

/**
 * Class Recipe
 *
 * @author Romain
 * 26/02/2020
 */
class Recipe {

    private $idRecipe;
    private $recipeTitle;
    private $recipe;
    private $recipeVisibility;
    private $idCooker;

    function __construct($idRecipe, $recipeTitle, $recipe, $recipeVisibility, $idCooker) {
        $this->idRecipe = $idRecipe;
        $this->recipeTitle = $recipeTitle;
        $this->recipe = $recipe;
        $this->recipeVisibility = $recipeVisibility;
        $this->idCooker = $idCooker;
    }

    public function getIdRecipe() {
        return $this->idRecipe;
    }

    public function getRecipeTitle() {
        return $this->recipeTitle;
    }

    public function getRecipe() {
        return $this->recipe;
    }

    public function getRecipeVisibility() {
        return $this->recipeVisibility;
    }

    public function getIdCooker() {
        return $this->idCooker;
    }

    public function setIdRecipe($idRecipe) {
        $this->idRecipe = $idRecipe;
    }

    public function setRecipeTitle($recipeTitle) {
        $this->recipeTitle = $recipeTitle;
    }

    public function setRecipe($recipe) {
        $this->recipe = $recipe;
    }

    public function setRecipeVisibility($recipeVisibility) {
        $this->recipeVisibility = $recipeVisibility;
    }

    public function setIdCooker($idCooker) {
        $this->idCooker = $idCooker;
    }

}
