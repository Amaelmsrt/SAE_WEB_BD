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

    function setName($name)
    {
        $this->name = $name;
    }

    function setPicture($picture)
    {
        $this->picture = $picture;
    }

    function toJson()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'picture' => $this->picture
        ]);
    }

    public function getPictureBase64() {
        $imageData = $this->getPicture(); // Supposons que cela renvoie un BLOB
        return base64_encode($imageData);
    }
}
