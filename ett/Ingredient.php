<?php

/**
 * Class ingredient
 *
 * @author Romain
 * 25/02/2020
 */
class Ingredient {

    private $idIngredient;
    private $ingredientName;
    private $ingredientCalorie;

    function __construct($idIngredient, $ingredientName, $ingredientCalorie) {
        $this->idIngredient = $idIngredient;
        $this->ingredientName = $ingredientName;
        $this->ingredientCalori = $ingredientCalorie;
    }

    public function getIdIngredient() {
        return $this->idIngredient;
    }

    public function getIngredientName() {
        return $this->ingredientName;
    }

    public function getIngredientCalorie() {
        return $this->ingredientCalori;
    }

    public function setIdIngredient($idIngredient) {
        $this->idIngredient = $idIngredient;
    }

    public function setIngredientName($ingredientName) {
        $this->ingredientName = $ingredientName;
    }

    public function setIngredientCalori($ingredientCalorie) {
        $this->ingredientCalori = $ingredientCalorie;
    }

}
