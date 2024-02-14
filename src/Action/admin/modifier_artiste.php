<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$artistDB = $manager->getArtistDB();
$id = $_POST['id_artiste'];
$name = $_POST['nom_artiste'];
$artist = $artistDB->find($id);
if (isset($_FILES['image_artiste']) && $_FILES['image_artiste']['error'] == 0) {
    $picture = file_get_contents($_FILES['image_artiste']['tmp_name']);
    $artist->setPicture($picture);
} else {
    $picture = null;
}
var_dump($picture);
$artist->setName($name);
$artistDB->update($artist);
header('Location: index.php?action=admin');
exit();