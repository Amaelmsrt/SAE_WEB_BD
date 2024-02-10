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

    public function find($id): ?Utilisateur {
        $sql = "SELECT * FROM utilisateur WHERE idUtilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $utilisateur = $stmt->fetch();
        return new Utilisateur($utilisateur['idUtilisateur'], $utilisateur['nomUtil'], $utilisateur['prenomUtil'], $utilisateur['pseudoUtil'], $utilisateur['emailUtil'], $utilisateur['mdpUtil']);
    }
    
    public function findWithPseudo($pseudo): ?Utilisateur {
        $sql = "SELECT * FROM utilisateur WHERE pseudoUtil = :pseudo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch();
    
        // Vérifier si $utilisateur est faux (false) ou vide
        if (!$utilisateur) {
            return null; // Retourner null si aucun utilisateur trouvé
        }
    
        // Si $utilisateur est un tableau valide, créer une instance de Utilisateur
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

    public function insertAdmin($nom, $prenom, $pseudo, $email, $mdp) {
        $sql = "INSERT INTO utilisateur (nomUtil, prenomUtil, pseudoUtil, emailUtil, mdpUtil, statutUser) VALUES (:nom, :prenom, :pseudo, :email, :mdp, 'Admin')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom, \PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $prenom, \PDO::PARAM_STR);
        $stmt->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt->bindValue(':mdp', $mdpHash, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update($utilisateur)
    {
        $sql = "UPDATE utilisateur SET nomUtil = :nom, prenomUtil = :prenom, pseudoUtil = :pseudo, emailUtil = :email, mdpUtil = :mdp, statutUser = :statut WHERE idUtilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom', $utilisateur->getNom(), \PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $utilisateur->getPrenom(), \PDO::PARAM_STR);
        $stmt->bindValue(':pseudo', $utilisateur->getPseudo(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $utilisateur->getEmail(), \PDO::PARAM_STR);
        $mdpHash = password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT);
        $stmt->bindValue(':mdp', $mdpHash, \PDO::PARAM_STR);
        $stmt->bindValue(':statut', $utilisateur->getStatut(), \PDO::PARAM_STR);
        $stmt->bindValue(':id', $utilisateur->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM utilisateur WHERE idUtilisateur = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
