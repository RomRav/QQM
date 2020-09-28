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
    private $qty;
    private $idUOM;

    function __construct($idIngredient, $ingredientName, $ingredientCalorie, $qty, $idUOM) {
        $this->idIngredient = $idIngredient;
        $this->ingredientName = $ingredientName;
        $this->ingredientCalorie = $ingredientCalorie;
        $this->qty = $qty;
        $this->idUOM = $idUOM;
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

    public function getqty() {
        return $this->qty;
    }

    public function getIdUOM() {
        return $this->idUOM;
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

    public function setQty($qty) {
        $this->qty = $qty;
    }

    public function setIdUOM($idUOM) {
        $this->idUOM = $idUOM;
    }

}
