<?php
declare(strict_types=1);

namespace DB;

class LikeAlbumDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function isLiked(int $idAlbum, int $idUtil): bool
    {
        $sql = "SELECT * FROM likeralbum WHERE idAlbum = :idAlbum AND idUtilisateur = :idUtil";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
        $like = $stmt->fetch();
        return $like !== false;
    }

    public function like(int $idAlbum, int $idUtil): void
    {
        if ($this->isLiked($idAlbum, $idUtil)) {
            $sql = "DELETE FROM likeralbum WHERE idAlbum = :idAlbum AND idUtilisateur = :idUtil";
        } else {
            $sql = "INSERT INTO likeralbum (idAlbum, idUtilisateur) VALUES (:idAlbum, :idUtil)";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idAlbum', $idAlbum, \PDO::PARAM_INT);
        $stmt->bindValue(':idUtil', $idUtil, \PDO::PARAM_INT);
        $stmt->execute();
    }
}