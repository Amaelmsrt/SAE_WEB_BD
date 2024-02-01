<?php
declare(strict_types=1);

namespace DB;

use Model\Son;

class SonDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function find($id): Son
    {
        $sql = "SELECT * FROM son WHERE idSon = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $son = $stmt->fetch();
        return new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['fichierMp3'], $son['idAlbum'], $son['nbStream']);
    }

    function findTop5Artist($idArtiste): array
    {
        $sql = "SELECT * FROM son JOIN album ON son.idAlbum = album.idAlbum WHERE album.idArtiste = :idArtiste ORDER BY nbStream DESC LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['fichierMp3'], $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }   

    function addStream($id)
    {
        $sql = "UPDATE son SET nbStream = nbStream + 1 WHERE idSon = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function addEcouter(int $idSon, int $idUtil)
    {
        $sql = "INSERT INTO EcouterRecement (idSon, idUtilisateur, dataHH) VALUES (:idSon, :idUtilisateur, datetime('now'))";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtilisateur', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function findEcouter(int $idUtil): array
    {
        $sql = "SELECT * FROM EcouterRecement JOIN son ON EcouterRecement.idSon = son.idSon WHERE EcouterRecement.idUtilisateur = :idUtilisateur ORDER BY dataHH DESC LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['fichierMp3'], $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }

    function findArtist(int $idArtiste): array
    {
        $sql = "SELECT * FROM son JOIN album ON son.idAlbum = album.idAlbum WHERE album.idArtiste = :idArtiste";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            // fichir mp3 est un blob
            $mp3 = base64_encode($son['fichierMp3']);
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $mp3, $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }

    function findAlbum(int $idAlbum): array
    {
        $sql = "SELECT * FROM son WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            // fichir mp3 est un blob
            $mp3 = base64_encode($son['fichierMp3']);
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $mp3, $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }
}