<?php
/**
 * Class Pays
 *
 * @author Romain
 * 20/02/2020
 */
class Pays {
    
    private $idPays;
    private $pays;
    
    function __construct($idPays, $pays) {
        $this->idPays = $idPays;
        $this->pays = $pays;
    }
    
    public function getIdPays() {
        return $this->idPays;
    }

    public function getPays() {
        return $this->pays;
    }

    public function setIdPays($idPays) {
        $this->idPays = $idPays;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }



}
