<?php

namespace Model;

class Genre {
    private $id;
    private $titre;

    public function __construct($id, $titre) {
        $this->id = $id;
        $this->titre = $titre;
    }

    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->titre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function toJson() {
        error_log("GENRE TO JSON");
        $json = json_encode([
            'id' => $this->id,
            'titre' => $this->titre
        ]);

        error_log($json);

        return $json;
    }
}