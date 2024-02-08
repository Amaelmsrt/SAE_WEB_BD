<?php
// Aucun espace ou texte indésirable avant cette balise

use DB\DataBaseManager as Manager;

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
                'cover' => $album->getCover(),
                'duree' => $son->getDuree(),
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
