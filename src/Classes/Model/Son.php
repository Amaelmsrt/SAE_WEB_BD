<?php

namespace Model;

/**
 * Class Son
 * 
 * Represents a song.
 */
class Son
{

    private $id;
    private $titre;
    private $duree;
    private $mp3;
    private $idAlbum;
    private $nbStream;
    private $album;

    /**
     * Son constructor.
     * 
     * @param int $id The ID of the song.
     * @param string $titre The title of the song.
     * @param int $duree The duration of the song in seconds.
     * @param string $mp3 The path to the MP3 file of the song.
     * @param int $idAlbum The ID of the album that the song belongs to.
     * @param int $nbStream The number of times the song has been streamed.
     */
    public function __construct($id, $titre, $duree, $mp3, $idAlbum, $nbStream)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->duree = $duree;
        $this->mp3 = $mp3;
        $this->idAlbum = $idAlbum;
        $this->nbStream = $nbStream;
    }

    /**
     * Get the ID of the song.
     * 
     * @return int The ID of the song.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Get the title of the song.
     * 
     * @return string The title of the song.
     */
    function getTitre()
    {
        return $this->titre;
    }

    /**
     * Get the duration of the song in seconds.
     * 
     * @return int The duration of the song in seconds.
     */
    function getDuree()
    {
        return $this->duree;
    }

    /**
     * Get the path to the MP3 file of the song.
     * 
     * @return string The path to the MP3 file of the song.
     */
    function getMp3()
    {
        return $this->mp3;
    }

    /**
     * Get the ID of the album that the song belongs to.
     * 
     * @return int The ID of the album that the song belongs to.
     */
    function getIdAlbum()
    {
        return $this->idAlbum;
    }

    /**
     * Get the number of times the song has been streamed.
     * 
     * @return int The number of times the song has been streamed.
     */
    function getNbStream()
    {
        return $this->nbStream;
    }

    /**
     * Set the title of the song.
     * 
     * @param string $titre The new title of the song.
     */
    function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Set the duration of the song in seconds.
     * 
     * @param int $duree The new duration of the song in seconds.
     */
    function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * Set the path to the MP3 file of the song.
     * 
     * @param string $mp3 The new path to the MP3 file of the song.
     */
    function setMp3($mp3)
    {
        $this->mp3 = $mp3;
    }

    /**
     * Set the ID of the album that the song belongs to.
     * 
     * @param int $idAlbum The new ID of the album that the song belongs to.
     */
    function setIdAlbum($idAlbum)
    {
        $this->idAlbum = $idAlbum;
    }

    /**
     * Set the album that the song belongs to.
     * 
     * @param Album $album The album that the song belongs to.
     */
    function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * Convert the song object to JSON format.
     * 
     * @return string The song object in JSON format.
     */
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