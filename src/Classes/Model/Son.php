<?php

namespace Model;


class Son
{

    private $id;
    private $titre;
    private $duree;
    private $mp3;
    private $idAlbum;

    public function __construct($id, $titre, $duree, $mp3, $idAlbum)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->duree = $duree;
        $this->mp3 = $mp3;
        $this->idAlbum = $idAlbum;
    }

    function getId()
    {
        return $this->id;
    }

    function getTitre()
    {
        return $this->titre;
    }

    function getDuree()
    {
        return $this->duree;
    }

    function getMp3()
    {
        return $this->mp3;
    }

    function getIdAlbum()
    {
        return $this->idAlbum;
    }
}