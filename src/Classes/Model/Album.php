<?php

namespace Model;

/**
 * Class Album
 * 
 * Represents an album.
 */
class Album
{

    /**
     * @var int The ID of the album.
     */
    private $id;

    /**
     * @var string The title of the album.
     */
    private $titre;

    /**
     * @var string The description of the album.
     */
    private $description;

    /**
     *  The date of the album.
     */
    private $date;

    /**
     *  The cover image of the album.
     */
    private $cover;

    /**
     * @var int The ID of the artist associated with the album.
     */
    private $idArtiste;

    /**
     * @var Artist The artist associated with the album.
     */
    private $artiste;

    private array $genres;

    /**
     * Album constructor.
     * 
     * @param int $id The ID of the album.
     * @param string $titre The title of the album.
     * @param string $description The description of the album.
     * @param $date The date of the album.
     * @param $cover The cover image of the album.
     * @param int $idArtiste The ID of the artist associated with the album.
     */
    public function __construct($id, $titre, $description, $date, $cover, $idArtiste)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->date = $date;
        $this->cover = $cover;
        $this->idArtiste = $idArtiste;
    }

    /**
     * Get the ID of the album.
     * 
     * @return int The ID of the album.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Get the title of the album.
     * 
     * @return string The title of the album.
     */
    function getTitre()
    {
        return $this->titre;
    }

    /**
     * Get the description of the album.
     * 
     * @return string The description of the album.
     */
    function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the date of the album.
     */
    function getDate()
    {
        return $this->date;
    }

    /**
     * Get the cover image of the album.
     */
    function getCover()
    {
        return $this->cover;
    }

    /**
     * Get the ID of the artist associated with the album.
     * 
     * @return int The ID of the artist associated with the album.
     */
    function getIdArtiste()
    {
        return $this->idArtiste;
    }

    /**
     * Set the title of the album.
     * 
     * @param string $titre The title of the album.
     */
    function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Set the description of the album.
     * 
     * @param string $description The description of the album.
     */
    function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set the date of the album.
     */
    function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Set the cover image of the album.
     */
    function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * Set the ID of the artist associated with the album.
     * 
     * @param int $idArtiste The ID of the artist associated with the album.
     */
    function setIdArtiste($idArtiste)
    {
        $this->idArtiste = $idArtiste;
    }

    /**
     * Convert the album object to JSON format.
     * 
     * @return string The album object in JSON format.
     */
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