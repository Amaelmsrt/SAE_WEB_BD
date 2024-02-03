<?php

declare (strict_types = 1);

namespace DB;

use Model\Playlist;

class PlaylistDB
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    function findAll(): array
    {
        $sql = "SELECT * FROM playlist";
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
        $sql = "SELECT * FROM playlist WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $playlist = $stmt->fetch();
        return new Playlist($playlist['idPlaylist'], $playlist['nomPlaylist'], $playlist['idUtilisateur']);
    }

    function findPlaylistsUser(int $idUtilisateur): array
    {
        $sql = "SELECT * FROM playlist WHERE idUtilisateur = :idUtilisateur";
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
        $sql = "INSERT INTO playlist (nomPlaylist, idUtilisateur) VALUES (:nomPlaylist, :idUtilisateur)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nomPlaylist', $playlist->getNom(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    function update(Playlist $playlist): void
    {
        $sql = "UPDATE playlist SET nomPlaylist = :nomPlaylist, idUtilisateur = :idUtilisateur WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nomPlaylist', $playlist->getNom(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $playlist->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    function delete(int $idPlaylist): void
    {
        $sql = "DELETE FROM playlist WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
    }
}