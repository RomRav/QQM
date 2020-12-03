<?php
/**
 * Connexion.php: une bibliotéque
 *  
 * seConnecter(): PDO(à partir d'un fichier ini)
 * seDeconnecter(): 
 *
 * @author Romain
 * 19/02/2020
 */

class Connexion {

    /**
     * seConnecter()
     * connexion à une BD 
     * @param type $parametresConnexion
     */
    public static function seConnecter() {
        //Récup des parametres de connexion à la BD.
        $parametre = parse_ini_file("bd.ini");

        $protocole = $parametre["protocole"];
        $serveur = $parametre["serveur"];
        $port = $parametre["port"];
        $bd = $parametre["bd"];
        $ut = $parametre["ut"];
        $mdp = $parametre["mdp"];

        /**
         * Connexion
         */
        $dsn = $protocole . ":dbname=" . $bd . ";host=" . $serveur . ";charset=utf8";
        $pdo = null;

        try {
            $pdo = new PDO($dsn, $ut, $mdp);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $pdo->exec("SET NAMES 'UTF8'");
        } catch (PDOException $ex) {
            echo 'Ereur de connexion : ', $ex->getMessage();
        }
     
        return $pdo;
    }

    /**
     * seDeconnecter()
     * Deconnexion de la BD
     * @param PDO $pdocnx
     */
    public static function seDeconnecter(PDO $pdocnx) {
        $pdocnx = null;
    }

}
