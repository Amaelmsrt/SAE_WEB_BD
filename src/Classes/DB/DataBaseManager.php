<?php
declare(strict_types=1);

namespace DB;

use PDO;

class DataBaseManager {

    private ArtistDB $artistDB;

    private LikeArtisteDB $likeArtisteDB;

    private LikeSonDB $likeSonDB;

    private SonDB $sonDB;

    private AlbumDB $albumDB;

    private LikeAlbumDB $likeAlbumDB;

    private UtilisateurDB $utilisateurDB;

    private GenreDB $genreDB;

    private RechercheDB $rechercheDB;

    private PlaylistDB $playlistDB;

    public function __construct() {
        $pdo = new PDO('sqlite:' . SQLITE_DB) ;
        $this->artistDB = new ArtistDB($pdo);
        $this->likeArtisteDB = new LikeArtisteDB($pdo);
        $this->likeSonDB = new LikeSonDB($pdo);
        $this->sonDB = new SonDB($pdo);
        $this->albumDB = new AlbumDB($pdo);
        $this->likeAlbumDB = new LikeAlbumDB($pdo);
        $this->utilisateurDB = new UtilisateurDB($pdo);
        $this->genreDB = new GenreDB($pdo);
        $this->rechercheDB = new RechercheDB($pdo);
        $this->playlistDB = new PlaylistDB($pdo);
    }

    public function getArtistDB(): ArtistDB {
        return $this->artistDB;
    }

    public function getLikeArtisteDB(): LikeArtisteDB {
        return $this->likeArtisteDB;
    }

    public function getLikeSonDB(): LikeSonDB {
        return $this->likeSonDB;
    }

    public function getSonDB(): SonDB {
        return $this->sonDB;
    }

    public function getAlbumDB(): AlbumDB {
        return $this->albumDB;
    }

    public function getLikeAlbumDB(): LikeAlbumDB {
        return $this->likeAlbumDB;
    }

    public function getUtilisateurDB(): UtilisateurDB {
        return $this->utilisateurDB;
    }

    public function getGenreDB(): GenreDB {
        return $this->genreDB;
    }
    public function getRechercheDB(): RechercheDB {
        return $this->rechercheDB;
    }

    public function getPlaylistDB(): PlaylistDB {
        return $this->playlistDB;
    }
}