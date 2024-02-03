<?php

namespace Model;

class Playlist 
{
    private $id;
    private $nom;
    private $idUtilisateur;

    public function __construct($id, $nom, $idUtilisateur)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->idUtilisateur = $idUtilisateur;
    }

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    function toJson()
    {
        error_log("PLAYLIST TO JSON");
        $json = json_encode([
            "id" => $this->id,
            "nom" => $this->nom,
            "idUtilisateur" => $this->idUtilisateur
        ]);
        error_log($json);
        return $json;
    }
}