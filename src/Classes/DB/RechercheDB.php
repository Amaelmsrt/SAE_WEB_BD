<?php
declare(strict_types=1);

namespace DB;

class RechercheDB
{

    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Fonction qui retourne soit l'artiste, soit l'album, soit le son correspondant le mieux à la recherche de l'utilisateur
     * Elle retourne un des trois types de données en fonction de la recherche
     * Je ne veux pas un array de données, je veux un seul élément
     * C'est une recherche par texte intégral (full text search)
     * J'ai des tables artist_fts, album_fts et son_fts qui sont des tables virtuelles qui contiennent les données des tables artist, album et son
     */
    public function search(string $recherche) 
    {
        $recherche = $recherche . '*';
        $query = $this->pdo->prepare('
            SELECT 
                "artiste" AS type,
                idArtiste AS id,
                nomArtiste AS nom
            FROM artist_fts
            WHERE artist_fts MATCH :recherche
            UNION
            SELECT 
                "album" AS type,
                idAlbum AS id,
                titreAlbum AS nom
            FROM album_fts
            WHERE album_fts MATCH :recherche
            UNION
            SELECT 
                "son" AS type,
                idSon AS id,
                titreSon AS nom
            FROM son_fts
            WHERE son_fts MATCH :recherche
        ');

        $query->execute([':recherche' => $recherche]);
        $result = $query->fetchAll();
        return $result;
    }
}