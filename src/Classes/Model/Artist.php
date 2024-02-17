<?php

namespace Model;

/**
 * Class Artist
 * 
 * Represents an artist.
 */
class Artist
{

    private $id;
    private $name;
    private $picture;

    /**
     * Artist constructor.
     * 
     * @param int $id The artist's ID.
     * @param string $name The artist's name.
     * @param $picture The artist's picture.
     */
    public function __construct($id, $name, $picture)
    {
        $this->id = $id;
        $this->name = $name;
        $this->picture = $picture;
    }

    /**
     * Get the artist's ID.
     * 
     * @return int The artist's ID.
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * Get the artist's name.
     * 
     * @return string The artist's name.
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * Get the artist's picture.
     * 
     * @return string The artist's picture.
     */
    function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the artist's name.
     * 
     * @param string $name The artist's name.
     */
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set the artist's picture.
     */
    function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Convert the artist object to JSON.
     * 
     * @return string The artist object in JSON format.
     */
    function toJson()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'picture' => $this->picture
        ]);
    }
}
