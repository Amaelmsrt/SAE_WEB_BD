<?php

namespace Model;


class Album
{

    private $id;
    private $titre;
    private $description;
    private $date;

    private $cover;
    private $idArtiste;

    private $artiste;

    public function __construct($id, $titre, $description, $date, $cover, $idArtiste)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->cover = $cover;
        $this->idArtiste = $idArtiste;
    }

    function getId()
    {
        return $this->id;
    }

    function getTitre()
    {
        return $this->titre;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getDate()
    {
        return $this->date;
    }

    function getCover()
    {
        return $this->cover;
    }

    function getIdArtiste()
    {
        return $this->idArtiste;
    }

    function setArtiste($artiste)
    {
        $this->artiste = $artiste;
    }

    function toJson()
    {
        return json_encode([
            'id' => $this->id,
            'titre' => $this->titre,
            'description' => $this->description,
            'date' => $this->date,
            'cover' => $this->cover,
            'idArtiste' => $this->idArtiste,
            'artiste' => $this->artiste->toJson()
        ]);
    }
}