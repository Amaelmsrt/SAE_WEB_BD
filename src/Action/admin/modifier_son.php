<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$sonDB = $manager->getSonDB();
$id = $_POST['id_son'];
$son = $sonDB->find($id);
$titre = $_POST['titre_son'];
$duree = $_POST['duree_son'];
$idAlbum = $_POST['album_son'];
if (isset($_FILES['mp3_son']) && $_FILES['mp3_son']['error'] == 0) {
    $mp3 = file_get_contents($_FILES['mp3_son']['tmp_name']);
} else {
    $mp3 = null;
}
$son->setTitre($titre);
$son->setDuree($duree);
$son->setMp3($mp3);
$son->setIdAlbum($idAlbum);
$sonDB->update($son);
header('Location: index.php?action=admin');
exit();