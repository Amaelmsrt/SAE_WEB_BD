<?php

namespace Model;


class Son
{

    private $id;
    private $titre;
    private $duree;
    private $mp3;
    private $idAlbum;
    private $nbStream;
    private $album;

    public function __construct($id, $titre, $duree, $mp3, $idAlbum, $nbStream)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->duree = $duree;
        $this->mp3 = $mp3;
        $this->idAlbum = $idAlbum;
        $this->nbStream = $nbStream;
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

    function getNbStream()
    {
        return $this->nbStream;
    }

    function setAlbum($album)
    {
        $this->album = $album;
    }

    function toJson()
    {
    error_log('SON TO JSON');
    $json = json_encode([
        'id' => $this->id,
        'titre' => $this->titre,
        'duree' => $this->duree,
        'idAlbum' => $this->idAlbum,
        'nbStream' => $this->nbStream,
        'album' => $this->album->toJson()
    ]);

    error_log($json);

    return $json;
}

}