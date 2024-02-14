<?php 

use DB\DataBaseManager;

$manager = new DataBaseManager();
$albumDB = $manager->getAlbumDB();
$id = $_POST['id_album'];
$album = $albumDB->findAlbum($id);
$albumDB->delete($id);
header('Location: index.php?action=admin');