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
}