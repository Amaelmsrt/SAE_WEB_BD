<?php

declare (strict_types = 1);

namespace DB;

use Model\Playlist;
use Model\Son;

class PlaylistDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function findAll(): array
    {
        $sql = "SELECT * FROM PLAYLIST";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $playlists = $stmt->fetchAll();
        $playlistsArray = [];
        foreach ($playlists as $playlist) {
            $playlistsArray[] = new Playlist($playlist['idPlaylist'], $playlist['nomPlaylist'], $playlist['idUtilisateur']);
        }
        return $playlistsArray;
    }

    function find(int $idPlaylist): Playlist
    {
        $sql = "SELECT * FROM PLAYLIST WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $playlist = $stmt->fetch();
        return new Playlist($playlist['idPlaylist'], $playlist['nomPlaylist'], $playlist['idUtilisateur']);
    }

    function findPlaylistsUser(int $idUtilisateur): array
    {
        $sql = "SELECT * FROM PLAYLIST WHERE idUtilisateur = :idUtilisateur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();
        $playlists = $stmt->fetchAll();
        $playlistsArray = [];
        foreach ($playlists as $playlist) {
            $playlistsArray[] = new Playlist($playlist['idPlaylist'], $playlist['nomPlaylist'], $playlist['idUtilisateur']);
        }
        return $playlistsArray;
    }

    function insert(Playlist $playlist): void
    {
        $sql = "INSERT INTO PLAYLIST (nomPlaylist, idUtilisateur) VALUES (:nomPlaylist, :idUtilisateur)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nomPlaylist', $playlist->getNom(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    function update(Playlist $playlist): void
    {
        $sql = "UPDATE PLAYLIST SET nomPlaylist = :nomPlaylist, idUtilisateur = :idUtilisateur WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nomPlaylist', $playlist->getNom(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $playlist->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    function delete(int $idPlaylist): void
    {
        $sql = "DELETE FROM PLAYLIST WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
    }

    function findAllSonsInPlaylist(int $idPlaylist): array
    {
        $sql = "SELECT * FROM SON WHERE idSon IN (SELECT idSon FROM CONSTITUER WHERE idPlaylist = :idPlaylist)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $songs = $stmt->fetchAll();
        $songsArray = [];
        foreach ($songs as $son) {
            $songsArray[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], null, $son['idAlbum'], $son['nbStream']);
        }
        return $songsArray;
    }

    function addSon(int $idSon, int $idPlaylist): array 
    {
        $sql = "INSERT INTO CONSTITUER (idSon, idPlaylist) VALUES (:idSon, :idPlaylist)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->findAllSonsInPlaylist($idPlaylist);
    }

    function deleteSon(int $idSon, int $idPlaylist): array
    {
        $sql = "DELETE FROM CONSTITUER WHERE idSon = :idSon AND idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->findAllSonsInPlaylist($idPlaylist);
    }

    function findAllSonsNotInPlaylist(int $idPlaylist): array 
    {
        $sql = "SELECT * FROM SON WHERE idSon NOT IN (SELECT idSon FROM CONSTITUER WHERE idPlaylist = :idPlaylist)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $songs = $stmt->fetchAll();
        $songsArray = [];
        foreach ($songs as $son) {
            $songsArray[] = new Son($son['idSon'], $son['titreSon'], $son['dureeSon'], null, $son['idAlbum'], $son['nbStream']);
        }
        return $songsArray;
    }
}