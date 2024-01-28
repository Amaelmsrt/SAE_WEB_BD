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

    public function __construct() {
        $pdo = new PDO('sqlite:' . SQLITE_DB) ;
        $this->artistDB = new ArtistDB($pdo);
        $this->likeArtisteDB = new LikeArtisteDB($pdo);
        $this->likeSonDB = new LikeSonDB($pdo);
        $this->sonDB = new SonDB($pdo);
        $this->albumDB = new AlbumDB($pdo);
        $this->likeAlbumDB = new LikeAlbumDB($pdo);
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
}