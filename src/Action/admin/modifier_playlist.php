<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$playlistDB = $manager->getPlaylistDB();
$idPlaylist = $_POST['id_playlist'];
$playlist = $playlistDB->find($idPlaylist);
$playlist->setNom($_POST['nom_playlist']);
$playlist->setIdUtilisateur($_POST['id_user']);
$playlistDB->update($playlist);
header('Location: index.php?action=admin');
exit();