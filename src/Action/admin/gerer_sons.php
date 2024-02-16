<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$playlistDB = $manager->getPlaylistDB();
$sonDB = $manager->getSonDB();
$playlist = $playlistDB->find($_POST["id_playlist"]);
$idPlaylist = $playlist->getId();
$sonAjoute = $sonDB->find($_POST["sons_a_ajouter"]);
$idSonAjoute = $sonAjoute != null ? $sonAjoute->getId() : null;
if ($idSonAjoute != null) {
    $playlistDB->addSon($idPlaylist, $idSonAjoute);
    echo "Son ajouté";
}
$sonSupprime = $sonDB->find($_POST["sons_a_supprimer"]);
$idSonSupprime = $sonSupprime != null ? $sonSupprime->getId() : null;
if ($idSonSupprime != null) {
    $playlistDB->deleteSon($idPlaylist, $idSonSupprime);
    echo "Son supprimé";
}
// header('Location: index.php?action=admin');
// exit();