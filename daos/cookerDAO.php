<?php

/**
 * CookerDAO.php
 * Bibliothéque d'accées au données utilisateur
 * @author Romain
 * 26/02/2020
 * last update: 09/12/2020
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
                $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd']);
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
    public static function selectOne(pdo $pdo,  $idCooker) {
        try {
            $requet = "SELECT * FROM qqm.cooker WHERE id_cooker = ? ;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $idCooker);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd']);
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
    public static function selectOneByPseudoAndMdp(pdo $pdo, $pseudo, $pwd) {
        try {
            $requet = "SELECT * FROM qqm.cooker WHERE pseudo = ? AND pwd=?;";
            $stmt = $pdo->prepare($requet);
            $stmt->bindParam(1, $pseudo);
            $stmt->bindParam(2, $pwd);
            $stmt->execute();
            $raw = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($raw != false) {
                $cooker = new Cooker($raw['id_cooker'], $raw['pseudo'], $raw['pwd']);
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
     * @param pdo $pdo
     * @param string $newCooker
     * @param string $newCookerPwd
     * @return type
     */
    public static function insert(pdo $pdo, $newCooker, $newCookerPwd) {
        try {
            $request = "INSERT INTO qqm.cooker(pseudo, pwd) VALUE(?,?);";
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCooker);
            $stmt->bindParam(2, $newCookerPwd);
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
    public static function delete(pdo $pdo, int $idCooker) {
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
    public static function update(pdo $pdo, int $idCooker, string $newCookerPseudo, string $newCookerPwd) {
        $request = 'UPDATE qqm.cooker SET pseudo = ?, pwd = ? WHERE id_cooker = ?';
        $liUpdated = 0;
        try {
            $stmt = $pdo->prepare($request);
            $stmt->bindParam(1, $newCookerPseudo);
            $stmt->bindParam(2, $newCookerPwd);
            $stmt->bindParam(3, $idCooker);
            $stmt->execute();
            $liUpdated = $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $liUpdated = -1;
        }
        return $liUpdated;
    }

}
