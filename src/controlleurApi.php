<?php
// Aucun espace ou texte indésirable avant cette balise

use DB\DataBaseManager as Manager;

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
