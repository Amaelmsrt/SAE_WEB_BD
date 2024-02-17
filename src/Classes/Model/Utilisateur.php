<?php

namespace Model;

/**
 * Classe Utilisateur
 * Représente un utilisateur du système.
 */
class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $mdp;
    private $statut = "User";

    /**
     * Constructeur de la classe Utilisateur.
     * @param int $id L'identifiant de l'utilisateur.
     * @param string $nom Le nom de l'utilisateur.
     * @param string $prenom Le prénom de l'utilisateur.
     * @param string $pseudo Le pseudo de l'utilisateur.
     * @param string $email L'adresse email de l'utilisateur.
     * @param string $mdp Le mot de passe de l'utilisateur.
     */
    public function __construct($id, $nom, $prenom, $pseudo, $email, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->mdp = $mdp;
    }

    /**
     * Retourne l'identifiant de l'utilisateur.
     * @return int L'identifiant de l'utilisateur.
     */
    function getId() {
        return $this->id;
    }

    /**
     * Retourne le nom de l'utilisateur.
     * @return string Le nom de l'utilisateur.
     */
    function getNom() {
        return $this->nom;
    }

    /**
     * Retourne le prénom de l'utilisateur.
     * @return string Le prénom de l'utilisateur.
     */
    function getPrenom() {
        return $this->prenom;
    }

    /**
     * Retourne le pseudo de l'utilisateur.
     * @return string Le pseudo de l'utilisateur.
     */
    function getPseudo() {
        return $this->pseudo;
    }

    /**
     * Retourne l'adresse email de l'utilisateur.
     * @return string L'adresse email de l'utilisateur.
     */
    function getEmail() {
        return $this->email;
    }

    /**
     * Retourne le mot de passe de l'utilisateur.
     * @return string Le mot de passe de l'utilisateur.
     */
    function getMdp() {
        return $this->mdp;
    }

    /**
     * Retourne le statut de l'utilisateur.
     * @return string Le statut de l'utilisateur.
     */
    function getStatut() {
        return $this->statut;
    }

    /**
     * Modifie l'identifiant de l'utilisateur.
     * @param int $id Le nouvel identifiant de l'utilisateur.
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Modifie le nom de l'utilisateur.
     * @param string $nom Le nouveau nom de l'utilisateur.
     */
    function setNom($nom) {
        $this->nom = $nom;
    }

    /**
     * Modifie le prénom de l'utilisateur.
     * @param string $prenom Le nouveau prénom de l'utilisateur.
     */
    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    /**
     * Modifie le pseudo de l'utilisateur.
     * @param string $pseudo Le nouveau pseudo de l'utilisateur.
     */
    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    /**
     * Modifie l'adresse email de l'utilisateur.
     * @param string $email La nouvelle adresse email de l'utilisateur.
     */
    function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Modifie le mot de passe de l'utilisateur.
     * @param string $mdp Le nouveau mot de passe de l'utilisateur.
     */
    function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    /**
     * Modifie le statut de l'utilisateur.
     * @param string $statut Le nouveau statut de l'utilisateur.
     */
    function setStatut($statut) {
        $this->statut = $statut;
    }

    /**
     * Convertit l'objet Utilisateur en format JSON.
     * @return string L'objet Utilisateur convertit en format JSON.
     */
    function toJson() {
        error_log('UTILISATEUR TO JSON');
        $json = json_encode([
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'pseudo' => $this->pseudo,
            'email' => $this->email,
            'mdp' => $this->mdp,
            'statut' => $this->statut
        ]);
        error_log($json);
        return $json;
    }
}

?>