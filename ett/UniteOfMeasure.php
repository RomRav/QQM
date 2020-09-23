<?php

/**
 * Class UniteOfMeasure
 * Description of UniteOfMeasure
 *
 * @author Romain
 * 23/09/2020
 */
class UniteOfMeasure {
    private $idUom;
    private $uom;
    
    function __construct($idUom, $uom) {
        $this->idUom = $idUom;
        $this->uom = $uom;
    }
    
    function getIdUom() {
        return $this->idUom;
    }

    function getUom() {
        return $this->uom;
    }

    function setIdUom($idUom) {
        $this->idUom = $idUom;
    }

    function setUom($uom) {
        $this->uom = $uom;
    }



}
