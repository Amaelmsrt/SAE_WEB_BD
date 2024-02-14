<?php

use DB\DataBaseManager;
use Model\Genre;

$manager = new DataBaseManager();
$genreDB = $manager->getGenreDB();
$name = $_POST['nom_nv_genre'];
$genre = new Genre(null, $name);
$genreDB->insert($genre);
header('Location: index.php?action=admin');
exit();