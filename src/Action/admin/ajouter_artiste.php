<?php

use DB\DataBaseManager;
use Model\Artist;

$manager = new DataBaseManager();
$artistDB = $manager->getArtistDB();
$name = $_POST['nom_nv_artiste'];
if (isset($_FILES['image_nv_artiste']) && $_FILES['image_nv_artiste']['error'] == 0) {
    $picture = file_get_contents($_FILES['image_nv_artiste']['tmp_name']);
} else {
    $picture = null;
}

$artist = new Artist(null, $name, $picture);
$artistDB->insert($artist);
header('Location: index.php?action=admin');
exit();