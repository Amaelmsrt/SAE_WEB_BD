<?php

namespace Model;

class Playlist
{

    private $id;
    private $titre;
    private $idUtilisateur;

    public function __construct($id, $titre, $idUtilisateur)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getIdUtilisateur()
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