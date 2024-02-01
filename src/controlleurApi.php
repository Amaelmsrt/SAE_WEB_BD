<?php
// Aucun espace ou texte indésirable avant cette balise

use DB\DataBaseManager as Manager;

ini_set('memory_limit', '1024M');

require_once 'Configuration/config.php';

// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 


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

        case 'jouerSon':
            $id = array_shift($path);
            $manager = new Manager();
            $son = $manager->getSonDB()->find($id);

            $manager->getSonDB()->addStream($id);
            session_start();
            $manager->getSonDB()->addEcouter($id, $_SESSION['user']);

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
            error_log(json_encode($response));
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
            echo json_encode($response);
            exit();

        case 'jouerAlbum':
            $idAlbum = array_shift($path);
            $manager = new Manager();
            $sons = $manager->getSonDB()->findAlbum($idAlbum);
            
            $response = array();
            foreach ($sons as $son) {
                $response[] = array(
                    'id' => $son->getId()
                );
            }
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
            
            $response = array(
                'id' => $son->getId(),
                'titre' => $son->getTitre(),
                'artiste' => $artist->getName(),
                'cover' => $album->getCover(),
                'duree' => $son->getDuree()
            );
            header('Content-Type: application/json'); // Indique que le contenu est en format JSON
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
