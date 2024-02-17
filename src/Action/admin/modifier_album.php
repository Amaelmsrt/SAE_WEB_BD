<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$albumDB = $manager->getAlbumDB();
$id = $_POST['id_album'];
$titre = $_POST['titre_album'];
$description = $_POST['description_album'];
$date = $_POST['date_album'];
$idArtiste = $_POST['id_artiste'];
$album = $albumDB->findAlbum($id);
if (isset($_FILES['cover_album']) && $_FILES['cover_album']['error'] == 0) {
    $cover = file_get_contents($_FILES['cover_album']['tmp_name']);
    $album->setCover($cover);
} else {
    $cover = null;
}
$album->setTitre($titre);
$album->setDescription($description);
$album->setDate($date);
$album->setIdArtiste($idArtiste);
$albumDB->update($album);
header('Location: index.php?action=admin');
exit();