<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$genreDB = $manager->getGenreDB();
$id = $_POST['id_genre'];
$genreDB->delete($id);
header('Location: index.php?action=admin');
exit();