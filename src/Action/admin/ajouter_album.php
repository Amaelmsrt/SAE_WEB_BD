<?php

use DB\DataBaseManager;
use Model\Album;

$manager = new DataBaseManager();
$albumDB = $manager->getAlbumDB();
$titre = $_POST['titre_album'];
$description = $_POST['description_album'];
$date = $_POST['date_album'];
$idArtiste = $_POST['id_artiste'];
if (isset($_FILES['cover_album']) && $_FILES['cover_album']['error'] == 0) {
    $cover = file_get_contents($_FILES['cover_album']['tmp_name']);
} else {
    $cover = null;
}

$album = new Album(null, $titre, $description, $date, $cover, $idArtiste);
$albumDB->insert($album);
header('Location: index.php?action=admin');
exit();