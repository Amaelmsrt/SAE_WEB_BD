<?php
declare(strict_types=1);

namespace DB;

use PDO;

class DataBaseManager {

    private ArtistDB $artistDB;

    public function __construct() {
        $pdo = new PDO('sqlite:' . SQLITE_DB) ;
        $this->artistDB = new ArtistDB($pdo);
    }

    public function getArtistDB(): ArtistDB {
        return $this->artistDB;
    }
}