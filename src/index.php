<?php

use View\Template;

require_once 'Configuration/config.php';

// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 


$action = $_REQUEST['action'] ?? "connexion";
$layout = "main";
session_start();
$_SESSION['user'] = $_SESSION['user_id'] ?? null;



ob_start();
switch ($action) {
        // case 'artist':
        //     include 'Action/artist.php';
        //     $layout = "artist";
        //     break;
        // case 'home':
        //     include 'Action/home.php';
        //     break;
        // case "search":
        //     include 'Action/search.php';
        //     $layout = "search";
        //     break;
        // case "playlist":
        //     include 'Action/playlist.php';
        //     break;
    case "home":
        include 'Action/accueil.php';
        $layout = "accueil";
        break;

    case "connexion":
        include 'Action/connexion.php';
        $layout = "connexion";
        break;
    case "inscription":
        include 'Action/inscription.php';
        $layout = 'inscription';
        break;
    case "deconnexion":
        include 'Action/deconnexion.php';
        break;
    case "admin":
        include 'Action/admin.php';
        $layout = "admin";
        break;
    default:
        include 'Action/connexion.php';
        $layout = "connexion";
        break;
}
$content = ob_get_clean();


// Template
$template = new Template('templates');
$template->setLayout($layout);
$template->setContent($content);

echo $template->compile();
