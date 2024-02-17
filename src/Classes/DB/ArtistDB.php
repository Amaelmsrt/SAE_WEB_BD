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

    public function findAll() {
        $sql = "SELECT * FROM artiste";
        $stmt = $this->pdo->query($sql);
        $artists = $stmt->fetchAll();
        $artistList = [];
        foreach ($artists as $artist) {
            $imageData = $artist['imageArtiste'];
            $decodedImage = ($imageData != null) ? base64_encode($imageData) : null; // Convertir le blob en base64
            $artistList[] = new Artist($artist['idArtiste'], $artist['nomArtiste'], $decodedImage);
        }
        return $artistList;
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) FROM ARTISTE";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchColumn();
    }

    public function find(int $id): Artist
    {
        $sql = "SELECT * FROM artiste WHERE idArtiste = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        $imageData = $artist['imageArtiste'];
        $decodedImage = ($imageData != null) ? base64_encode($imageData) : null; // Convertir le blob en base64
        return new Artist($artist['idArtiste'], $artist['nomArtiste'], $decodedImage);
    }

    public function getAleaArtists(): array
    {
        $sql = "SELECT * FROM artiste ORDER BY RANDOM() LIMIT 15";
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

    public function insert(Artist $artiste): void
    {
        $sql = "INSERT INTO artiste (nomArtiste, imageArtiste) VALUES (:name, :image)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $artiste->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':image', $artiste->getPicture(), \PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function update(Artist $artiste): void
    {
        $sql = "UPDATE artiste SET nomArtiste = :name, imageArtiste = :image WHERE idArtiste = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $artiste->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':image', $artiste->getPicture(), \PDO::PARAM_LOB);
        $stmt->bindValue(':id', $artiste->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM artiste WHERE idArtiste = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getPicture(int $id): string
    {
        $sql = "SELECT imageArtiste FROM artiste WHERE idArtiste = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        $imageData = $artist['imageArtiste'];
        $decodedImage = base64_encode($imageData); // Convertir le blob en base64
        return $decodedImage;
    }
}