<?php
declare(strict_types=1);

namespace DB;

use Model\Artist;

class LikeSonDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function nbLikeArtist(int $idArtiste, int $idUtil): int
    {
        $sql = "SELECT COUNT(*) FROM likerson JOIN son ON likerson.idSon = son.idSon JOIN album ON son.idAlbum = album.idAlbum where album.idArtiste = :idArtiste AND likerson.idUtilisateur = :idUtil";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
        $nbLike = $stmt->fetch();
        return $nbLike[0];
    }

    function isLiked(int $idSon, int $idUtil): bool
    {
        $sql = "SELECT * FROM likerson WHERE idSon = :idSon AND idUtilisateur = :idUtil";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
        $like = $stmt->fetch();
        return $like !== false;
    }

    function like(int $idSon, int $idUtil): void
    {
        if ($this->isLiked($idSon, $idUtil)) {
            $sql = "DELETE FROM likerson WHERE idSon = :idSon AND idUtilisateur = :idUtil";
        } else {
            $sql = "INSERT INTO likerson (idSon, idUtilisateur) VALUES (:idSon, :idUtil)";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
    }
}