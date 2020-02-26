<?php
/**
 * Class Cooker
 *
 * @author Romain
 * 26/02/2020
 */
class Cooker {
    private $idCooker;
    private $pseudo;
    private $pwd;

    function __construct($idCooker, $pseudo, $pwd) {
        $this->idCooker = $idCooker;
        $this->pseudo = $pseudo;
        $this->pwd = $pwd;
    }
    
    public function getIdCooker() {
        return $this->idCooker;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function setIdCooker($idCooker) {
        $this->idCooker = $idCooker;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }




}
