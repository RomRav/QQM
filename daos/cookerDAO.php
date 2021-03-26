<?php

/**
 * CookerDAO.php
 * Bibliothéque d'accées au données utilisateur
 * @author Romain
 * 26/02/2020
 * last update: 25/03/2021
 *  
 * selectAll($pdo): récupération de la liste de tous les utilisateurs
 * selectOne($pdo, $id): récupération d'un utilisateur
 * insert(): ajout d'un utilisateur
 * update($id): modification d'un utilisateur
 * delete($id): Supression d'un utilisateur
 */
require_once 'Connexion.php';
require_once '../ett/Cooker.php';

class CookerDAO {

    /**
     * selectAll()
     * @author Romain Ravault
     * 26/02/202
     * @return Object Table
     */
    public static function selectAll($pdo) {
        $listCooker = [];
        try {
            $requet = "SELECT * FROM cooker;";
            $raws = $pdo->query($requet);
            $raws->setFetchMode(PDO::FETCH_ASSOC);
            while ($raw = $raws->fetch()) {
                $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd'], $raw['admin']);
                array_push($listCooker, $cooker);
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $listCooker;
    }

    /**
     * selectOne()
     * @author Romain Ravault
     * 26/02/202
     * @return type
     */
    public static function selectOne(pdo $pdo, $idCooker) {
        try {
            $requet = "SELECT * FROM qqm.cooker WHERE id_cooker = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idCooker);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd'], $raw['admin']);
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $cooker;
    }

    /**
     * selectOneByPseudo()
     * @author Romain Ravault
     * 26/02/202
     * @return type
     */
    public static function selectOneByPseudo(pdo $pdo, $pseudo) {
        try {
            $requet = "SELECT * FROM qqm.cooker WHERE pseudo = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $pseudo);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($raw != false) {
                $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd'], $raw['admin']);
            } else {
                $cooker = null;
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $cooker;
    }

    /**
     * insert()
     * @author Romain Ravault
     * 26/02/2020
     * Last update: 16/12/2020
     * @param pdo $pdo
     * @param string $newCooker
     * @param string $newCookerPwd
     * @return type
     */
    public static function insert(pdo $pdo, $newCooker, $newCookerPwd, $adminStatus) {
        try {
            $newCookerPwd = self::passwordCrypter($newCookerPwd);
            $request = "INSERT INTO qqm.cooker(pseudo, pwd, admin) VALUE(?,?,?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCooker);
            $stmt->bindParam(2, $newCookerPwd);
            $stmt->bindParam(3, $adminStatus);
            $stmt->execute();
            $insertVerif = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $insertVerif = -1;
        }
        return $insertVerif;
    }

    /**
     * delete()
     * @author Romain Ravault
     * 26/02/2020
     * 
     * @param pdo $pdo
     * @param int $idCooker   
     * @return type
     */
    public static function delete(pdo $pdo, $idCooker) {
        $liDelete = 0;
        $request = "DELETE FROM qqm.cooker WHERE id_cooker = ?";
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $idCooker);
            $stmt->execute();
            $liDelete = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liDelete = -1;
        }
        return$liDelete;
    }

    /**
     * update()
     * @author Romain Ravault
     * 26/02/2020
     * 
     * @param pdo $pdo
     * @param int $idCooker
     * @param string $newCookerPseudo
     * @param string $newCookerPwd
     * @return type
     */
    public static function update(pdo $pdo, $idCooker, $newCookerPseudo, $newCookerPwd, $newAdminStatus) {
        $request = 'UPDATE qqm.cooker SET pseudo = ?, pwd = ?, admin = ? WHERE id_cooker = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCookerPseudo);
            $stmt->bindParam(2, $newCookerPwd);
            $stmt->bindParam(3, $idCooker);
            $stmt->bindParam(4, $newAdminStatus);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

    /**
     * passwordHash()
     * @author Romain Ravault
     * 23/03/2021
     * Hash le mot de passe.
     * 
     * @param type $pass
     * @return type
     */
    public static function passwordCrypter($pass) {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /**
     * getPassword()
     * @author Romain Ravault
     * 23/03/2021
     * Récupérer le mot de passe d'un utilisateur.
     * 
     * @param PDO $pdo
     * @param type $pseudo
     * @return type
     */
    public static function getPassword(PDO $pdo, $pseudo) {
        try {
            var_dump($pseudo);
            $requet = "SELECT pwd FROM qqm.cooker WHERE pseudo = ?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $pseudo);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($raw != false) {
                $dbPwd = $raw['pwd'];
            } else {
                $dbPwd = null;
            }
        } catch (PDOException $ex) {
            echo 'ERREUR:' . $ex->getMessage();
        }
        return $dbPwd;
    }

    /**
     * checkPassword()
     * @author Romain Ravault
     * 23/03/2021
     * 
     * @param PDO $pdo
     * @param type $pseudo
     * @param type $mdp
     * @return boolean
     */
    public static function checkPassword(PDO $pdo, $pseudo, $mdp) {
        if (empty($mdp)) {
            return false;
        }
        $dbMdp = self::getPassword($pdo, $pseudo);
        var_dump($dbMdp);
        $verif = password_verify($mdp, $dbMdp);
        return $verif;
    }

}
