<?php
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
use DB\DataBaseManager;
use Model\Son;

$manager = new DataBaseManager();
$sonDB = $manager->getSonDB();
$titre = $_POST['titre_nv_son'];
$duree = $_POST['duree_nv_son'];
$idAlbum = $_POST['album_nv_son'];
var_dump($_FILES['mp3_nv_son']);
if (isset($_FILES['mp3_nv_son']) && $_FILES['mp3_nv_son']['error'] == 0) {
    $mp3 = file_get_contents($_FILES['mp3_nv_son']['tmp_name']);
} else {
    $mp3 = null;
}
$son = new Son(null, $titre, $duree, $mp3, $idAlbum, 0);
$sonDB->insert($son);
header('Location: index.php?action=admin');
exit();