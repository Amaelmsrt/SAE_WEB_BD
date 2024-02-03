<?php

use DB\DataBaseManager;
$manager = new DataBaseManager();

$artistDB = $manager->getArtistDB();
$liste_artistes = $artistDB->findAll();

$pageSize = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $pageSize;

$sonDB = $manager->getSonDB();
$liste_sons = $sonDB->findAll($offset, $pageSize);

$genreDB = $manager->getGenreDB();
$liste_genres = $genreDB->findAll();

$utilisateurDB = $manager->getUtilisateurDB();
$liste_utilisateurs = $utilisateurDB->findAll();

$playlistDB = $manager->getPlaylistDB();
$liste_playlists = $playlistDB->findAll();

$albumDB = $manager->getAlbumDB();
$liste_albums = $albumDB->findAll();

?>

<aside>
    <div class="container-aside">
        <a href="index.php?action=accueil" class="btn-retour">Retour application</a>
        <nav>
            <ul>
                <li>
                    <a href="" id="goToMenuPrincipal">
                        <svg width="27" height="17" viewBox="0 0 27 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.83325 1.2085H25.1666M1.83325 8.50016H25.1666M1.83325 15.7918H25.1666" stroke="#010101" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Menu principal
                    </a>
                </li>
                <li>
                    <a href="" id="goToArtistes">
                        Artistes
                    </a>
                </li>
                <li>
                    <a href="" id="goToSons">
                        Sons
                    </a>
                </li>
                <li>
                    <a href="" id="goToGenres">
                        Genres
                    </a>
                </li>
                <li>
                    <a href="" id="goToUtilisateurs">
                        Utilisateurs
                    </a>
                </li>
                <li>
                    <a href="" id="goToPlaylists">
                        Playlists
                    </a>
                </li>
                <li>
                    <a href="" id="goToAlbums">
                        Albums
                    </a>
                </li>
            </ul>
        </nav>

        <div class="actions">
            <img src="/assets/icons/add-circle.svg"/>
        </div>
    </div>
</aside>