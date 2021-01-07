<?php

/**
 * Class Recipe
 *
 * @author Romain
 * 20/12/2020
 */
class Recipe {

    private $idRecipe;
    private $recipeTitle;
    private $recipe;
    private $recipeVisibility;
    private $idCooker;
    private $photoFileName;

    function __construct($idRecipe, $recipeTitle, $recipe, $recipeVisibility, $idCooker, $photoFileName) {
        $this->idRecipe = $idRecipe;
        $this->recipeTitle = $recipeTitle;
        $this->recipe = $recipe;
        $this->recipeVisibility = $recipeVisibility;
        $this->idCooker = $idCooker;
        $this->photoFileName = $photoFileName;
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

    public function getPhotoFileName() {
        return $this->photoFileName;
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

    public function setPhotoFileName($photoFileName) {
        $this->photoFileName = $photoFileName;
    }

}
