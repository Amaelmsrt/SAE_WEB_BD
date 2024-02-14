<?php

use DB\DataBaseManager;
use Model\Playlist;

$manager = new DataBaseManager();
$playlistDB = $manager->getPlaylistDB();
$idPlaylist = $_POST['id_playlist'];
$playlistDB->delete($idPlaylist);
header('Location: index.php?action=admin');
exit();