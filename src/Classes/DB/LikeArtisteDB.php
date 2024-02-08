<?php
declare(strict_types=1);

namespace DB;

class LikeArtisteDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function isLiked(int $idArtiste, int $idUtil): bool
    {
        $sql = "SELECT * FROM likerartiste WHERE idArtiste = :idArtiste AND idUtilisateur = :idUtil";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
        $like = $stmt->fetch();
        return $like !== false;
    }

    public function like(int $idArtiste, int $idUtil): void
    {
        if ($this->isLiked($idArtiste, $idUtil)) {
            $sql = "DELETE FROM likerartiste WHERE idArtiste = :idArtiste AND idUtilisateur = :idUtil";
        } else {
            $sql = "INSERT INTO likerartiste (idArtiste, idUtilisateur) VALUES (:idArtiste, :idUtil)";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArtiste', $idArtiste, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
    }
}