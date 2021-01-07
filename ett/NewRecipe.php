<?php

/**
 * Class newRecipe
 *
 * @author Romain
 * 07/01/2021
 */
class NewRecipe {

    private $title;
    private $season;
    private $position;
    private $content;
    private $recipe;
    private $ingredient = [];
    private $country;
    private $photoFileName;

    function __construct($title, $season, $position, $content, $recipe, $ingredient, $country, $photoFileName) {
        $this->title = $title;
        $this->season = $season;
        $this->position = $position;
        $this->content = $content;
        $this->recipe = $recipe;
        $this->ingredient = $ingredient;
        $this->country = $country;
        $this->photoFileName = $photoFileName;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSeason() {
        return $this->season;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getContent() {
        return $this->content;
    }

    public function getRecipe() {
        return $this->recipe;
    }

    public function getIngredient() {
        return $this->ingredient;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPhotoFileName() {
        return $this->photoFileName;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSeason($season) {
        $this->season = $season;
    }

    public function setPosition($position) {
        $this->position = $position;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setRecipe($recipe) {
        $this->recipe = $recipe;
    }

    public function setIngredient($ingredient) {
        $this->ingredient = $ingredient;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setPhotoFileName($photoFileName) {
        $this->photoFileName = $photoFileName;
    }

}
