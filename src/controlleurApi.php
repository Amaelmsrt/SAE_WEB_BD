<?php
// Aucun espace ou texte indésirable avant cette balise

use DB\DataBaseManager as Manager;
use Model\Playlist;

ini_set('memory_limit', '2048M');

require_once 'Configuration/config.php';

// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $action = array_shift($path);
    $action = array_shift($path);
    $response = ['error' => 'Not Found'];
    // print si ici
    switch ($action) {

        case 'likeArtiste':
            $id = array_shift($path);
            $userId = array_shift($path);
            
            $manager = new Manager();
            
            $manager->getLikeArtisteDB()->like($id, $userId);
            $isLike = $manager->getLikeArtisteDB()->isLiked($id, $userId);

            $response = ['like' => $isLike];
            break;

        case 'likeAlbum':
            $id = array_shift($path);
            $userId = array_shift($path);
            
            $manager = new Manager();
            
            $manager->getLikeAlbumDB()->like($id, $userId);
            $isLike = $manager->getLikeAlbumDB()->isLiked($id, $userId);

            $response = ['like' => $isLike];
            break;

        case 'likeSon':
            $id = array_shift($path);
            $userId = array_shift($path);
            
            $manager = new Manager();
            
            $manager->getLikeSonDB()->like($id, $userId);
            $isLike = $manager->getLikeSonDB()->isLiked($id, $userId);

            $response = ['like' => $isLike];
            break;

        case 'jouerSon':
            $id = array_shift($path);
            $manager = new Manager();
            $son = $manager->getSonDB()->find($id);

            $manager->getSonDB()->addStream($id);
            $manager->getSonDB()->addEcouter($id, $_SESSION['user_id']);

            header('Content-Type: audio/mpeg');
            echo $son->getMp3();

            exit();

        case 'jouerPlaylist':
            $id = array_shift($path);
            $manager = new Manager();
            $playlist = $manager->getPlaylistDB()->getSons($id);
            $response = array();
            foreach ($playlist as $son) {
                $response[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($son->getId())
                );
            }
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'jouerArtiste':
            $idArtist = array_shift($path);
            $manager = new Manager();
            $sons = $manager->getSonDB()->findArtist($idArtist);
            
            $response = array();
            foreach ($sons as $son) {
                $response[] = array(
                    'id' => $son->getId()
                );
            }
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'jouerFavorite':
            $id = array_shift($path);
            $manager = new Manager();
            $sons = $manager->getSonDB()->findLike($id);
            
            $response = array();
            foreach ($sons as $son) {
                $response[] = array(
                    'id' => $son->getId()
                );
            }
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'jouerAlbum':
            $idAlbum = array_shift($path);
            $manager = new Manager();
            $response = $manager->getSonDB()->findAlbum($idAlbum);
            error_log(json_encode($response));
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'infosSon' :
            $id = array_shift($path);
            $manager = new Manager();
            $son = $manager->getSonDB()->find($id);
            $album = $manager->getAlbumDB()->findAlbum($son->getIdAlbum());
            $artist = $manager->getArtistDB()->find($album->getIdArtiste());
            $likeSonDB = $manager->getLikeSonDB();
            
            $response = array(
                'id' => $son->getId(),
                'titre' => $son->getTitre(),
                'artiste' => $artist->getName(),
                'idArtist' => $artist->getId(),
                'cover' => $album->getCover(),
                'duree' => $son->getDuree(),
                'album' => $album->getId(),
                'idUser' => $_SESSION['user_id'], // 'idUser' => $_SESSION['user_id'] ?? '
                'isLiked' => $likeSonDB->isLiked($id, $_SESSION['user_id']),
            );
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'recherche':
            $recherche = array_shift($path);
            $recherche = str_replace('_', ' ', $recherche);
            $searchValue = urldecode($recherche);
            $manager = new Manager();

            $response = $manager->getRechercheDB()->getInfosSearch($searchValue);

            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'artiste' :
            $id = array_shift($path);
            $manager = new Manager();
            $artist = $manager->getArtistDB()->find($id);
            $topSon = $manager->getSonDB()->findTopArtist($id);
            $topSonJson = array();
            foreach ($topSon as $son) {
                $topSonJson[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($son->getId())
                );
            }
            $result = array(
                'id' => $artist->getId(),
                'nom' => $artist->getName(),
                'cover' => $artist->getPicture(),
                'topSon' => $topSonJson
            );
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($result);
            exit();

        case 'album' :
            $id = array_shift($path);
            $manager = new Manager();
            $album = $manager->getAlbumDB()->findAlbum($id);
            $artist = $manager->getArtistDB()->find($album->getIdArtiste());
            $topSon = $manager->getSonDB()->findTopSonAlbum($id);
            $topSonJson = array();
            foreach ($topSon as $son) {
                $topSonJson[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($son->getId())
                );
            }
            $result = array(
                'id' => $album->getId(),
                'titre' => $album->getTitre(),
                'cover' => $album->getCover(),
                'artiste' => $artist->getName(),
                'topSon' => $topSonJson
            );
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($result);
            exit();

        case 'son' :
            $id = array_shift($path);
            $manager = new Manager();
            $son = $manager->getSonDB()->find($id);
            $album = $manager->getAlbumDB()->findAlbum($son->getIdAlbum());
            $artist = $manager->getArtistDB()->find($album->getIdArtiste());
            $result = array(
                'id' => $son->getId(),
                'titre' => $son->getTitre(),
                'artiste' => $artist->getName(),
                'cover' => $album->getCover(),
            );
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($result);
            exit();

        case 'artistInfo':
            $id = array_shift($path);
            $manager = new Manager();
            $artist = $manager->getArtistDB()->find($id);
            $album = $manager->getAlbumDB()->findAlbumsArtist($id);
            $nbLike = $manager->getLikeSonDB()->countLikes($id, $_SESSION['user_id']);
            $topSonArtist = $manager->getSonDB()->findTopArtist5($id);
            $topSonJson = array();
            foreach ($topSonArtist as $son) {
                $topSonJson[] = array(
                    'id' => $son->getId(),
                    'titre' => $son->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($son->getId()),
                    'idAlbum' => $son->getIdAlbum()
                );
            }
            $albumJson = array();
            foreach ($album as $alb) {
                $albumJson[] = array(
                    'id' => $alb->getId(),
                    'titre' => $alb->getTitre(),
                    'cover' => $alb->getCover()
                );
            }
            $result = array(
                'id' => $artist->getId(),
                'nom' => $artist->getName(),
                'cover' => $artist->getPicture(),
                'albums' => $albumJson,
                'topSon' => $topSonJson,
                'nbLikes' => $nbLike
            );
            header('Content-Type: application/json');
            echo json_encode($result);
            exit();

        case 'albumInfo':
            $id = array_shift($path);
            $manager = new Manager();
            $album = $manager->getAlbumDB()->findAlbum($id);
            $artist = $manager->getArtistDB()->find($album->getIdArtiste());
            $son = $manager->getSonDB()->findSonOfAlbum($id);
            $sonJson = array();
            foreach ($son as $s) {
                $sonJson[] = array(
                    'id' => $s->getId(),
                    'titre' => $s->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($s->getId())
                );
            }
            $nbLike = $manager->getLikeSonDB()->countLikes($artist->getId(), $_SESSION['user_id']);

            $genres = $manager->getAlbumDB()->findGenres($id);
            $genresToJson = array();
            foreach ($genres as $genre) {
                $genresToJson[] = $genre;
            }

            $result = array(
                'id' => $album->getId(),
                'titre' => $album->getTitre(),
                'cover' => $album->getCover(),
                'artiste' => $artist->getName(),
                'date' => $album->getDate(),
                'genres' => $genresToJson,
                'description' => $album->getDescription(),
                'nbLikes' => $nbLike,
                'sons' => $sonJson,
                'idArtiste' => $artist->getId()
            );
            header('Content-Type: application/json');
            echo json_encode($result);
            exit();

        case 'newPlaylist':
            // Type post
            $manager = new Manager();
            $titre = array_shift($path);
            $titreDecoded = urldecode($titre);
            $songs = array_shift($path);
            // les sons sont séparés par des virgules
            $sonsId = explode(',', $songs);
            $userId = $_SESSION['user_id'];
            $playlist = new Playlist(0, $titreDecoded, $userId);
            $idPlaylist = $manager->getPlaylistDB()->createPlaylist($playlist);
            foreach ($sonsId as $idSon) {
                $manager->getPlaylistDB()->addSon($idPlaylist, $idSon);
            }
            $artisteString = "";
            foreach ($manager->getPlaylistDB()->getArtistes($idPlaylist) as $artiste) {
                $artisteString .= $artiste . ", ";
            }
            $artisteString = substr($artisteString, 0, -2);
            $response = ['id' => $idPlaylist, 'titre' => $titreDecoded, 'artiste' => $artisteString];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        case 'getPlaylist':
            $id = array_shift($path);
            $manager = new Manager();
            $playlist = $manager->getPlaylistDB()->getPlaylistId($id);
            $son = $manager->getPlaylistDB()->getSons($id);
            $sonJson = array();
            foreach ($son as $s) {
                $album = $manager->getAlbumDB()->findAlbum($s->getIdAlbum());
                $artist = $manager->getArtistDB()->find($album->getIdArtiste());
                $sonJson[] = array(
                    'id' => $s->getId(),
                    'titre' => $s->getTitre(),
                    'cover' => $manager->getSonDB()->getCover($s->getId()),
                    'artist' => $artist->getName(),
                    'album' => $album->getId(),
                    'idArtist' => $artist->getId(),
                );
            }
            $response = array(
                'id' => $playlist->getId(),
                'titre' => $playlist->getTitre(),
                'duree' => $manager->getPlaylistDB()->getDuree($playlist->getId()),
                'sons' => $sonJson,
                'idUser' => $_SESSION['user_id'],
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        case 'removeFromPlaylist':
            $idSon = array_shift($path);
            $idPlaylist = array_shift($path);
            $manager = new Manager();
            $manager->getPlaylistDB()->removeSon($idPlaylist, $idSon);
            $response = ['success' => 'true'];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        default:
            // Ne définissez pas de code de réponse HTTP ici
            $response = ['error' => 'Not Found'];
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Méthode non autorisée
}
