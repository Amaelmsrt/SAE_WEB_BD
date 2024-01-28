<?php

use View\Template;

require_once 'Configuration/config.php';

// SPL autoloader
require 'Classes/autoloader.php'; 
Autoloader::register(); 


$action = $_REQUEST['action'] ?? "home";
$layout = "main";


ob_start();
switch ($action) {
    case 'home':
        include 'Action/home.php';
        break;
    case "search":
        include 'Action/search.php';
        $layout = "search";
        break;
    case "playlist":
        include 'Action/playlist.php';
        break;
    default:
        include 'Action/connexion.php';
        break;
}
$content = ob_get_clean();


// Template
$template = new Template('templates');
$template->setLayout($layout);
$template->setContent($content);

echo $template->compile();
