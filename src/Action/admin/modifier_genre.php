<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$genreDB = $manager->getGenreDB();
$id = $_POST['id_genre'];
$genre = $genreDB->find($id);
$genre->setTitre($_POST['titre_genre']);
$genreDB->update($genre);
header('Location: index.php?action=admin');
exit();