<?php


/**
 * Class Season
 *
 * @author Romain
 * 24/02/2020
 */
class Type{
    private $idType;
    private $typeName;
    
    function __construct($idTyper, $typeName) {
        $this->idType = $idTyper;
        $this->typeName = $typeName;
    }
    
    
    public function getIdType() {
        return $this->idType;
    }

    public function getTypeName() {
        return $this->typeName;
    }

    public function setIdType($idType) {
        $this->idType = $idType;
    }

    public function setTypeName($typeName) {
        $this->typeName = $typeName;
    }



}
