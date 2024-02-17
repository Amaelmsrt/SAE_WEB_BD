<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$artistDB = $manager->getArtistDB();
$id = $_POST['id_artiste'];
$artistDB->delete($id);
header('Location: index.php?action=admin');
exit();