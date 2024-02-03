<?php

namespace Model;

class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $email;
    private $mdp;

    private $statut = "User";

    public function __construct($id, $nom, $prenom, $pseudo, $email, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->mdp = $mdp;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getEmail() {
        return $this->email;
    }

    function getMdp() {
        return $this->mdp;
    }

    function getStatut() {
        return $this->statut;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

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