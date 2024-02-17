<?php

namespace Model;

/**
 * Class Playlist
 * 
 * Represents a playlist object.
 */
class Playlist
{
    /**
     * @var int The ID of the playlist.
     */
    private $id;

    /**
     * @var string The title of the playlist.
     */
    private $titre;

    /**
     * @var int The ID of the user who owns the playlist.
     */
    private $idUtilisateur;

    private $songs;

    private $user;

    /**
     * Playlist constructor.
     *
     * @param int $id The ID of the playlist.
     * @param string $titre The title of the playlist.
     * @param int $idUtilisateur The ID of the user who owns the playlist.
     */
    public function __construct($id, $titre, $idUtilisateur)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Get the ID of the playlist.
     *
     * @return int The ID of the playlist.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the title of the playlist.
     *
     * @return string The title of the playlist.
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Get the ID of the user who owns the playlist.
     *
     * @return int The ID of the user who owns the playlist.
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the ID of the playlist.
     *
     * @param int $id The ID of the playlist.
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set the title of the playlist.
     *
     * @param string $titre The title of the playlist.
     */
    function setNom($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Set the ID of the user who owns the playlist.
     *
     * @param int $idUtilisateur The ID of the user who owns the playlist.
     */
    function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * Convert the playlist object to JSON format.
     *
     * @return string The JSON representation of the playlist object.
     */
    function toJson()
    {
        error_log("PLAYLIST TO JSON");
        $json = json_encode([
            "id" => $this->id,
            "titre" => $this->titre,
            "idUtilisateur" => $this->idUtilisateur
        ]);
        error_log($json);
        return $json;
    }
}