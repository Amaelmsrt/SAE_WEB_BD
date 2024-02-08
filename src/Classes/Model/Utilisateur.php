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
}

?>