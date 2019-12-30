<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nouvRecette
 *
 * @author User
 */
class nouvRecette {

    //put your code here
    private $saison;
    private $type;
    private $contenu;
    private $recette;
    private $titre;

    function __construct($titre, $saison, $type, $contenu, $recette) {
        $this->titre = $titre;
        $this->saison = $saison;
        $this->type = $type;
        $this->contenu = $contenu;
        $this->recette = $recette;
    }

    function getTitre() {
        return $this->titre;
    }

    function getSaison() {
        return $this->saison;
    }

    function getType() {
        return $this->type;
    }

    function getContenu() {
        return $this->contenu;
    }

    function getRecette() {
        return $this->recette;
    }

    function setSaison($saison) {
        $this->saison = $saison;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    function setRecette($recette) {
        $this->recette = $recette;
    }

}
