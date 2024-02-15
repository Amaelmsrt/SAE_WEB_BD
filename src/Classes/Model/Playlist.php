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
}