<?php

namespace Model;

/**
 * Classe représentant un genre.
 */
class Genre {
    private $id;
    private $titre;

    /**
     * Constructeur de la classe Genre.
     *
     * @param int $id L'identifiant du genre.
     * @param string $titre Le titre du genre.
     */
    public function __construct($id, $titre) {
        $this->id = $id;
        $this->titre = $titre;
    }

    /**
     * Obtient l'identifiant du genre.
     *
     * @return int L'identifiant du genre.
     */
    function getId() {
        return $this->id;
    }

    /**
     * Obtient le titre du genre.
     *
     * @return string Le titre du genre.
     */
    function getTitre() {
        return $this->titre;
    }

    /**
     * Définit l'identifiant du genre.
     *
     * @param int $id Le nouvel identifiant du genre.
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * Définit le titre du genre.
     *
     * @param string $titre Le nouveau titre du genre.
     */
    function setTitre($titre) {
        $this->titre = $titre;
    }

    /**
     * Convertit l'objet Genre en format JSON.
     *
     * @return string L'objet Genre converti en format JSON.
     */
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