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

    function findTop5Artist($idArtiste): array
    {
        $sql = "SELECT * FROM son JOIN album ON son.idAlbum = album.idAlbum WHERE album.idArtiste = :idArtiste ORDER BY nbStream DESC LIMIT 5";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = $stmt->fetchAll();
        $sonList = [];
        foreach ($sons as $son) {
            $sonList[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], $son['nbStream'], $son['idAlbum']);
        }
        return $sonList;
    }
}