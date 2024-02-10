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
    case "ajouter_artiste":
        include 'Action/admin/ajouter_artiste.php';
        break;
    case "supprimer_artiste":
        include 'Action/admin/supprimer_artiste.php';
        break;
    case "modifier_artiste":
        include 'Action/admin/modifier_artiste.php';
        break;
    case "ajouter_genre":
        include 'Action/admin/ajouter_genre.php';
        break;
    case "supprimer_genre":
        include 'Action/admin/supprimer_genre.php';
        break;
    case "modifier_genre":
        include 'Action/admin/modifier_genre.php';
        break;
    case "ajouter_utilisateur":
        include 'Action/admin/ajouter_utilisateur.php';
        break;
    case "supprimer_utilisateur":
        include 'Action/admin/supprimer_utilisateur.php';
        break;
    case "modifier_utilisateur":
        include 'Action/admin/modifier_utilisateur.php';
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
