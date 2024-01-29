<?php

namespace Model;

class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $mdp;

    public function __construct($id, $nom, $prenom, $pseudo, $mdp) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
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

    function getMdp() {
        return $this->mdp;
    }
}

?>