<?php

use DB\DataBaseManager;
$manager = new DataBaseManager();

$artistDB = $manager->getArtistDB();
$liste_artistes = $artistDB->findAll();

$sonDB = $manager->getSonDB();
$liste_sons = $sonDB->findAll();

$genreDB = $manager->getGenreDB();
$liste_genres = $genreDB->findAll();

$utilisateurDB = $manager->getUtilisateurDB();
$liste_utilisateurs = $utilisateurDB->findAll();

$playlistDB = $manager->getPlaylistDB();
$liste_playlists = $playlistDB->findAll();

$albumDB = $manager->getAlbumDB();
$liste_albums = $albumDB->findAll();

?>