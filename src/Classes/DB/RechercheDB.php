<?php
declare(strict_types=1);

namespace DB;

class RechercheDB
{

    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Fonction qui retourne soit l'artiste, soit l'album, soit le son correspondant le mieux à la recherche de l'utilisateur
     * Elle retourne un des trois types de données en fonction de la recherche
     * Je ne veux pas un array de données, je veux un seul élément
     * C'est une recherche par texte intégral (full text search)
     * J'ai des tables artist_fts, album_fts et son_fts qui sont des tables virtuelles qui contiennent les données des tables artist, album et son
     */
    public function search(string $recherche) 
    {
        $recherche = $recherche . '*';
        $query = $this->pdo->prepare('
            SELECT 
                "artiste" AS type,
                idArtiste AS id,
                nomArtiste AS nom
            FROM artist_fts
            WHERE artist_fts MATCH :recherche
            UNION
            SELECT 
                "album" AS type,
                idAlbum AS id,
                titreAlbum AS nom
            FROM album_fts
            WHERE album_fts MATCH :recherche
            UNION
            SELECT 
                "son" AS type,
                idSon AS id,
                titreSon AS nom
            FROM son_fts
            WHERE son_fts MATCH :recherche
        ');

        $query->execute([':recherche' => $recherche]);
        $result = $query->fetchAll();
        return $result;
    }

    public function getInfosSearch(string $recherche)
    {
        $artistDB = new ArtistDB($this->pdo);
        $albumDB = new AlbumDB($this->pdo);
        $sonDB = new SonDB($this->pdo);
        $result = $this->search($recherche);
        if ($this->hasArtist($result)) {
            $principal = $this->hasArtist($result);
            $topSon = $sonDB->findTopArtist($principal['id']);
            $topSonJson = array();
            foreach ($topSon as $son) {
                $topSonJson[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $sonDB->getCover($son->getId())
                );
            }
            $principalJson = array(
                'id' => $principal['id'],
                'nom' => $principal['nom'],
                'cover' => $artistDB->getPicture($principal['id']),
                'artiste' => $principal['nom'],
                'topSon' => $topSonJson
            );
            $albums = $this->getAlbumsOther($result);
            $artists = $this->getArtists($result, $principal['id']);

        } elseif ($this->hasAlbum($result)) {
            $principal = $this->hasAlbum($result);
            $topSon = $sonDB->findTopSonAlbum($principal['id']);
            $topSonJson = array();
            foreach ($topSon as $son) {
                $topSonJson[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $sonDB->getCover($son->getId())
                );
            }
            $artists = [];
            $albums = $this->getAlbums($result, $principal['id']);
            $principalJson = array(
                'id' => $principal['id'],
                'nom' => $principal['nom'],
                'cover' => $albumDB->getCover($principal['id']),
                'artiste' => $albumDB->getArtist($principal['id']),
                'topSon' => $topSonJson
            );

        } else {
            if (empty($result)) {
                return array(
                    'principal' => [],
                    'artistes' => [],
                    'albums' => []
                );
            }
            $first = array_shift($result);
            $topSonJson = [];
            for ($i = 0; $i < 3 && $i < count($result); $i++) {
                $topSonJson[] = array(
                    'id' => $result[$i]['id'],
                    'titre' => $result[$i]['nom'],
                    'artiste' => $sonDB->getArtist($result[$i]['id']),
                    'cover' => $sonDB->getCover($result[$i]['id'])
                );
            }
            $principalJson = array(
                'id' => $first['id'],
                'nom' => $first['nom'],
                'cover' => $sonDB->getCover($first['id']),
                'type' => $sonDB->getArtist($first['id']),
                'topSon' => $topSonJson
            );
            
            $artists = [];
            $albums = [];
            return array(
                'principal' => $principalJson,
                'artistes' => $artists,
                'albums' => $albums
            );
        }


        $artistsJson = [];
        foreach ($artists as $artist) {
            $artistsJson[] = array(
                'id' => $artist['id'],
                'nom' => $artist['nom'],
                'cover' => $artistDB->getPicture($artist['id'])
            );
        }
        $albumsJson = [];
        foreach ($albums as $album) {
            $albumsJson[] = array(
                'id' => $album['id'],
                'nom' => $album['nom'],
                'artiste' => $albumDB->getArtist($album['id']),
                'cover' => $albumDB->getCover($album['id'])
            );
        }
        $result = array(
            'principal' => $principalJson,
            'artistes' => $artistsJson,
            'albums' => $albumsJson
        );
        return $result;
    }

    public function getAlbumsOther(array $result)
    {
        $res = [];
        foreach ($result as $row) {
            if ($row['type'] === 'album') {
                $res[] = $row;
            }
        }
        return $res;
    }

    public function getArtists(array $result, int $idArtiste)
    {
        $res = [];
        foreach ($result as $row) {
            if ($row['type'] === 'artiste' && $row['id'] !== $idArtiste) {
                $res[] = $row;
            }
        }
        return $res;
    }

    public function getAlbums(array $result, int $idAlbum)
    {
        $res = [];
        foreach ($result as $row) {
            if ($row['type'] === 'album' && $row['id'] !== $idAlbum) {
                $res[] = $row;
            }
        }
        return $res;
    }

    public function hasArtist(array $result)
    {
        foreach ($result as $row) {
            if ($row['type'] === 'artiste') {
                return $row;
            }
        }
        return false;
    }

    public function hasAlbum(array $result)
    {
        foreach ($result as $row) {
            if ($row['type'] === 'album') {
                return $row;
            }
        }
        return false;
    }
}