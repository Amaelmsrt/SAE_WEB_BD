<?php

declare(strict_types=1);

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
        $stmt->bindValue(':nomPlaylist', $playlist->getTitre(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->execute();
    }

    function update(Playlist $playlist): void
    {
        $sql = "UPDATE PLAYLIST SET nomPlaylist = :nomPlaylist, idUtilisateur = :idUtilisateur WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nomPlaylist', $playlist->getTitre(), \PDO::PARAM_STR);
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

    public function getPlaylist(int $idUtilisateur): array
    {
        $sql = "SELECT * FROM playlist WHERE idUtilisateur = :idUtilisateur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();
        $playlist = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $playlist[] = new Playlist($row['idPlaylist'], $row['nomPlaylist'], $row['idUtilisateur']);
        }

        return $playlist;
    }

    public function createPlaylist(Playlist $playlist): int
    {
        $sql = "INSERT INTO playlist (nomPlaylist, idUtilisateur) VALUES (:titre, :idUtilisateur)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':titre', $playlist->getTitre(), \PDO::PARAM_STR);
        $stmt->bindValue(':idUtilisateur', $playlist->getIdUtilisateur(), \PDO::PARAM_INT);
        $stmt->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function addSon($idPlaylist, $idSon): void
    {
        // Si le son n'est deja pas dans la playlist on l'ajoute
        $sql = "SELECT * FROM constituer WHERE idPlaylist = :idPlaylist AND idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetch(\PDO::FETCH_ASSOC)) {
            return;
        }
        $sql = "INSERT INTO Constituer (idPlaylist, idSon) VALUES (:idPlaylist, :idSon)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getArtistes(int $idPlaylist): array
    {
        $sql = "SELECT nomArtiste FROM son s JOIN constituer c ON s.idSon = c.idSon JOIN album a ON a.idAlbum = s.idAlbum JOIN artiste aa ON aa.idArtiste = a.idArtiste WHERE c.idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $artistes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $artistes[] = $row['nomArtiste'];
        }
        return $artistes;
    }

    public function getPlaylistId(int $idPlaylist): Playlist
    {
        $sql = "SELECT * FROM playlist WHERE idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Playlist($row['idPlaylist'], $row['nomPlaylist'], $row['idUtilisateur']);
    }

    public function getDuree(int $idPlaylist): String
    {
        $sql = "SELECT dureeSon FROM son s JOIN constituer c ON s.idSon = c.idSon WHERE c.idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $duree = 0.00;
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // dureeSon format 4:02
            error_log($row['dureeSon']);
            $row['dureeSon'] = explode(':', $row['dureeSon']);
            $duree += (float)$row['dureeSon'][0] * 60 + (float)$row['dureeSon'][1];
        }
        return (string)floor($duree / 60) . ':' . str_pad((string)($duree % 60), 2, '0', STR_PAD_LEFT);
    }
    
    public function getSons(int $idPlaylist): array
    {
        $sql = "SELECT * FROM son s JOIN constituer c ON s.idSon = c.idSon WHERE c.idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $sons[] = new Son($row['idSon'], $row['titreSon'], $row['dureeSon'], $row['fichierMp3'], $row['idAlbum'], $row['nbStream']);
        }
        return $sons;
    }

    public function getSonsAdmin(int $idPlaylist): array
    {
        $sql = "SELECT s.idSon, s.titreSon, s.dureeSon, s.idAlbum, s.nbStream FROM son s JOIN constituer c ON s.idSon = c.idSon WHERE c.idPlaylist = :idPlaylist";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->execute();
        $sons = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $sons[] = new Son($row['idSon'], $row['titreSon'], $row['dureeSon'], null, $row['idAlbum'], $row['nbStream']);
        }
        return $sons;
    }

    public function removeSon(int $idPlaylist, int $idSon): void
    {
        $sql = "DELETE FROM constituer WHERE idPlaylist = :idPlaylist AND idSon = :idSon";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, \PDO::PARAM_INT);
        $stmt->bindValue(':idSon', $idSon, \PDO::PARAM_INT);
        $stmt->execute();
    }
}