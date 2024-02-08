<?php
declare(strict_types=1);

namespace DB;

use Model\Album;

class AlbumDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function find(int $idSon): Album
    {
        $sql = "SELECT * FROM album JOIN son ON album.idAlbum = son.idAlbum WHERE son.idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        $album = $stmt->fetch();
        $imageData = $album['coverAlbum'];
        $decodedImage = base64_encode($imageData); // Convertir le blob en base64
        return new Album($album['idAlbum'], $album['titreAlbum'], $album['descriptionAlbum'], $album['dateAlbum'], $decodedImage, $album['idArtiste']);
    }

    function findAlbum(int $idAlbum): Album
    {
        $sql = "SELECT * FROM album WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $album = $stmt->fetch();
        $imageData = $album['coverAlbum'];
        $decodedImage = base64_encode($imageData); // Convertir le blob en base64
        return new Album($album['idAlbum'], $album['titreAlbum'], $album['descriptionAlbum'], $album['dateAlbum'], $decodedImage, $album['idArtiste']);
    }

    function findAlbumsArtist(int $idArtiste): array
    {
        $sql = "SELECT * FROM album WHERE idArtiste = :idArtiste";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        $albumsArray = [];
        foreach ($albums as $album) {
            $imageData = $album['coverAlbum'];
            $decodedImage = base64_encode($imageData); // Convertir le blob en base64
            $albumsArray[] = new Album($album['idAlbum'], $album['titreAlbum'], $album['descriptionAlbum'], $album['dateAlbum'], $decodedImage, $album['idArtiste']);
        }
        return $albumsArray;
    }

    function getAleaAlbums(): array
    {
        $sql = "SELECT * FROM album ORDER BY RANDOM() LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        $albumsArray = [];
        foreach ($albums as $album) {
            $imageData = $album['coverAlbum'];
            $decodedImage = base64_encode($imageData); // Convertir le blob en base64
            $albumsArray[] = new Album($album['idAlbum'], $album['titreAlbum'], $album['descriptionAlbum'], $album['dateAlbum'], $decodedImage, $album['idArtiste']);
        }
        return $albumsArray;
    }

    function getLastAlbums(): array
    {
        $sql = "SELECT * FROM album ORDER BY dateAlbum DESC LIMIT 15";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $albums = $stmt->fetchAll();
        $albumsArray = [];
        foreach ($albums as $album) {
            $imageData = $album['coverAlbum'];
            $decodedImage = base64_encode($imageData); // Convertir le blob en base64
            $albumsArray[] = new Album($album['idAlbum'], $album['titreAlbum'], $album['descriptionAlbum'], $album['dateAlbum'], $decodedImage, $album['idArtiste']);
        }
        return $albumsArray;
    }

    function getCover(int $idAlbum): string
    {
        $sql = "SELECT coverAlbum FROM album WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $cover = $stmt->fetch();
        return base64_encode($cover['coverAlbum']);
    }

    function getArtist(int $idAlbum): string
    {
        $sql = "SELECT idArtiste FROM album WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        $sql = "SELECT nomArtiste FROM artiste WHERE idArtiste = :idArtiste";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $artist['idArtiste'], \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        return $artist['nomArtiste'];
    }
}