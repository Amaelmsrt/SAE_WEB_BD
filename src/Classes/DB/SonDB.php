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
        $sql = "SELECT * FROM EcouterRecement WHERE idSon = :idSon AND idUtilisateur = :idUtilisateur";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([':idSon' => $idSon, ':idUtilisateur' => $idUtil])) {
            $result = $stmt->fetch();
            if ($result) {
                $sql = "UPDATE EcouterRecement SET dataHH = datetime('now') WHERE idSon = :idSon AND idUtilisateur = :idUtilisateur";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
                $stmt->bindValue(':idUtilisateur', $idUtil, \PDO::PARAM_INT);
                $stmt->execute();
                return;
            }
        }
        $sql = "INSERT INTO EcouterRecement (idSon, idUtilisateur, dataHH) VALUES (:idSon, :idUtilisateur, datetime('now'))";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtilisateur', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function findEcouter(int $idUtil): array
    {
        $sql = "SELECT * FROM EcouterRecement JOIN son ON EcouterRecement.idSon = son.idSon WHERE EcouterRecement.idUtilisateur = :idUtilisateur ORDER BY dataHH DESC LIMIT 16";
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
        $sql = "SELECT idSon FROM son WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $sonList = [];
        $start = microtime(true);
        while ($son = $stmt->fetch()) {
            $sonList[] = $son['idSon'];
        }
        $end = microtime(true);
        $time = $end - $start;
        error_log("findAlbum: " . $time);
        return $sonList;
    }

    function findSonOfAlbum(int $idAlbum): array
    {
        $sql = "SELECT * FROM son WHERE idAlbum = :idAlbum";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['fichierMp3'], $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }

    function findTopArtist(int $idArtiste): array
    {
        $sql = "SELECT * FROM son JOIN album ON son.idAlbum = album.idAlbum WHERE album.idArtiste = :idArtiste ORDER BY nbStream DESC LIMIT 3";
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

    function findTopArtist5(int $idArtiste): array
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

    function getCover(int $idSon): string
    {

        $sql = "SELECT coverAlbum FROM album JOIN son ON album.idAlbum = son.idAlbum WHERE son.idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        $cover = $stmt->fetch();
        return base64_encode($cover['coverAlbum']);
    }

    function findTopSonAlbum(int $idAlbum): array
    {
        $sql = "SELECT * FROM son WHERE idAlbum = :idAlbum ORDER BY nbStream DESC LIMIT 3";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['fichierMp3'], $son['idAlbum'], $son['nbStream']);
        }
        return $sonList;
    }

    function getArtist(int $idSon): string
    {
        $sql = "SELECT nomArtiste FROM artiste JOIN album ON artiste.idArtiste = album.idArtiste JOIN son ON album.idAlbum = son.idAlbum WHERE son.idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        $artist = $stmt->fetch();
        return $artist['nomArtiste'];
    }

    function getIdAlbum(int $idSon): int
    {
        $sql = "SELECT idAlbum FROM son WHERE idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        $album = $stmt->fetch();
        return $album['idAlbum'];
    }

    function getIdArtist(int $idSon): int
    {
        $sql = "SELECT idArtiste FROM album JOIN son ON album.idAlbum = son.idAlbum WHERE son.idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        $artiste = $stmt->fetch();
        return $artiste['idArtiste'];
    }
}