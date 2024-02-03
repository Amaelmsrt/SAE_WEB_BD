<?php

declare (strict_types=1);

namespace DB;

use Model\Utilisateur;

class UtilisateurDB {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll();
        $utilisateursArray = [];
        foreach ($utilisateurs as $utilisateur) {
            $utilisateursArray[] = new Utilisateur($utilisateur['idUtilisateur'], $utilisateur['nomUtil'], $utilisateur['prenomUtil'], $utilisateur['pseudoUtil'], $utilisateur['emailUtil'], $utilisateur['mdpUtil']);
        }
        return $utilisateursArray;
    }

    public function find($pseudo): ?Utilisateur {
        $sql = "SELECT * FROM utilisateur WHERE pseudoUtil = :pseudo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch();
    
        if ($utilisateur === false) {
            return null;
        }
    
        return new Utilisateur($utilisateur['idUtilisateur'], $utilisateur['nomUtil'], $utilisateur['prenomUtil'], $utilisateur['pseudoUtil'], $utilisateur['emailUtil'], $utilisateur['mdpUtil']);
    }
    

    public function insertUser($nom, $prenom, $pseudo, $email, $mdp) {
        $sql = "INSERT INTO utilisateur (nomUtil, prenomUtil, pseudoUtil, emailUtil, mdpUtil, statutUser) VALUES (:nom, :prenom, :pseudo, :email, :mdp, 'User')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom, \PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt->bindValue(':mdp', $mdpHash, \PDO::PARAM_STR);
        $stmt->execute();
    }
}
