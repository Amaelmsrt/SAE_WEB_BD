<?php

use DB\DataBaseManager;
use Model\Playlist;

$manager = new DataBaseManager();
$playlistDB = $manager->getPlaylistDB();
$name = $_POST['nom_nv_playlist'];
$idUtilisateur = $_POST['nom_user_playlist'];
$playlist = new Playlist(null, $name, $idUtilisateur);
$playlistDB->insert($playlist);

header('Location: index.php?action=admin');
exit();