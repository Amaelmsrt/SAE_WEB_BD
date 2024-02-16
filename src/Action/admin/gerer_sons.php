<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$playlistDB = $manager->getPlaylistDB();
$sonDB = $manager->getSonDB();
$playlist = $playlistDB->find($_POST["id_playlist"]);
$idPlaylist = $playlist->getId();

if (isset($_POST["sons_a_ajouter"]) && $_POST["sons_a_ajouter"] != "0") {
    $sonAjoute = $sonDB->find($_POST["sons_a_ajouter"]);
    $idSonAjoute = $sonAjoute != null ? $sonAjoute->getId() : null;
    if ($idSonAjoute != null) {
        $playlistDB->addSon($idPlaylist, $idSonAjoute);
        echo "Son ajouté";
    }
}

if (isset($_POST["sons_a_supprimer"]) && $_POST["sons_a_supprimer"] != "0") {
    $sonSupprime = $sonDB->find($_POST["sons_a_supprimer"]);
    $idSonSupprime = $sonSupprime != null ? $sonSupprime->getId() : null;
    if ($idSonSupprime != null) {
        $playlistDB->deleteSon($idPlaylist, $idSonSupprime);
        echo "Son supprimé";
    }
}

header('Location: index.php?action=admin');
exit();