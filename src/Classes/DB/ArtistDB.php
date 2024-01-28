<?php
declare(strict_types=1);

namespace DB;

use Model\Artist;

class ArtistDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM artiste";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $artists = $stmt->fetchAll();
        $artistList = [];
        foreach ($artists as $artist) {
            $imageData = $artist['imageArtiste'];
            $decodedImage = base64_encode($imageData); // Convertir le blob en base64
            $artistList[] = new Artist($artist['idArtiste'], $artist['nomArtiste'], $decodedImage);
        }
        return $artistList;
    }

    public function find(int $id): Artist
    {
        $sql = "SELECT * FROM artiste WHERE idArtiste = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        $imageData = $artist['imageArtiste'];
        $decodedImage = base64_encode($imageData); // Convertir le blob en base64
        return new Artist($artist['idArtiste'], $artist['nomArtiste'], $decodedImage);
    }
}