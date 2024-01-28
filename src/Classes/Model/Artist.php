<?php

namespace Model;


class Artist
{

    private $id;
    private $name;
    private $picture;

    public function __construct($id, $name, $picture)
    {
        $this->id = $id;
        $this->name = $name;
        $this->picture = $picture;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getPicture()
    {
        return $this->picture;
    }

}