<?php
use DB\DataBaseManager;
$manager = new DataBaseManager();

// Artistes
$artistDB = $manager->getArtistDB();
$liste_artistes = $artistDB->findAll();

// Sons
$sonDB = $manager->getSonDB();
$liste_sons = $sonDB->findAll();

// Genres
$genreDB = $manager->getGenreDB();
$liste_genres = $genreDB->findAll();

// Utilisateurs
$utilisateurDB = $manager->getUtilisateurDB();
$liste_utilisateurs = $utilisateurDB->findAll();


// Playlists
$playlistDB = $manager->getPlaylistDB();
$liste_playlists = $playlistDB->findAll();

// Albums
$albumDB = $manager->getAlbumDB();
$liste_albums = $albumDB->findAll();


?>

<aside>
    <div class="left">
        
        <a href="index.php?action=accueil" class="btn-retour">
            <svg width="26" height="16" viewBox="0 0 26 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.22816 1.73682L2.00009 7.96489M2.00009 7.96489L8.22816 14.193M2.00009 7.96489H24.4211" stroke="currentColor" stroke-width="2.49123" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Retour application
        </a>
        <nav>
            <ul>
                <li>
                    <a href="" id="goToMenuPrincipal">
                        <svg width="27" height="17" viewBox="0 0 27 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.83325 1.2085H25.1666M1.83325 8.50016H25.1666M1.83325 15.7918H25.1666" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Menu principal
                    </a>
                </li>
                <li>
                    <a href="" id="goToArtistes">
                        <svg width="30" height="23" viewBox="0 0 30 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.9866 21.7082H26.1667C27.7775 21.7082 29.1809 20.3606 28.6692 18.8332C27.8893 16.5055 25.9706 15.0979 22.5977 14.6103M18.146 9.84388C18.5703 9.97801 19.0564 10.0415 19.6042 10.0415C22.0347 10.0415 23.25 8.7915 23.25 5.6665C23.25 2.5415 22.0347 1.2915 19.6042 1.2915C19.0564 1.2915 18.5703 1.355 18.146 1.48913M10.8542 14.4165C16.6277 14.4165 19.4474 16.1838 20.1527 19.7183C20.3689 20.8015 19.4379 21.7082 18.3333 21.7082H3.375C2.27043 21.7082 1.33943 20.8015 1.5556 19.7183C2.26098 16.1838 5.08064 14.4165 10.8542 14.4165ZM10.8542 10.0415C13.2847 10.0415 14.5 8.7915 14.5 5.6665C14.5 2.5415 13.2847 1.2915 10.8542 1.2915C8.42361 1.2915 7.20833 2.5415 7.20833 5.6665C7.20833 8.7915 8.42361 10.0415 10.8542 10.0415Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Artistes
                    </a>
                </li>
                <li>
                    <a href="" id="goToSons">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.75 14.5C5.75 11.2613 7.50962 8.43351 10.125 6.92059M23.25 14.2123C23.25 17.451 21.4904 20.2788 18.875 21.7917M27.625 14.5C27.625 21.7487 21.7487 27.625 14.5 27.625C7.25126 27.625 1.375 21.7487 1.375 14.5C1.375 7.25126 7.25126 1.375 14.5 1.375C21.7487 1.375 27.625 7.25126 27.625 14.5ZM17.4167 14.5C17.4167 16.1108 16.1108 17.4167 14.5 17.4167C12.8892 17.4167 11.5833 16.1108 11.5833 14.5C11.5833 12.8892 12.8892 11.5833 14.5 11.5833C16.1108 11.5833 17.4167 12.8892 17.4167 14.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Sons
                    </a>
                </li>
                <li>
                    <a href="" id="goToGenres">
                        <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.29175 7.04183H15.8751M1.29175 1.2085H15.8751M1.29175 12.8752H10.0417M15.8751 12.8752V18.7085L21.7084 15.7918L15.8751 12.8752Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Genres
                    </a>
                </li>
                <li>
                    <a href="" id="goToUtilisateurs">
                        <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Utilisateurs
                    </a>
                </li>
                <li>
                    <a href="" id="goToPlaylists">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3C1 1.89543 1.89543 1 3 1H4C5.10457 1 6 1.89543 6 3V4C6 5.10457 5.10457 6 4 6H3C1.89543 6 1 5.10457 1 4V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 3C10 1.89543 10.8954 1 12 1H13C14.1046 1 15 1.89543 15 3V4C15 5.10457 14.1046 6 13 6H12C10.8954 6 10 5.10457 10 4V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1 12C1 10.8954 1.89543 10 3 10H4C5.10457 10 6 10.8954 6 12V13C6 14.1046 5.10457 15 4 15H3C1.89543 15 1 14.1046 1 13V12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 12C10 10.8954 10.8954 10 12 10H13C14.1046 10 15 10.8954 15 12V13C15 14.1046 14.1046 15 13 15H12C10.8954 15 10 14.1046 10 13V12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Playlists
                    </a>
                </li>
                <li>
                    <a href="" id="goToAlbums">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.8125 21.8333C8.8125 24.1345 7.06361 26 4.90625 26C2.74889 26 1 24.1345 1 21.8333C1 19.5321 2.74889 17.6667 4.90625 17.6667C7.06361 17.6667 8.8125 19.5321 8.8125 21.8333ZM8.8125 21.8333V3.57439C8.8125 3.05949 9.20349 2.62875 9.71598 2.57906L24.9035 1.10633C25.4912 1.04934 26 1.51124 26 2.10166V20.1667M26 20.1667C26 22.4679 24.2511 24.3333 22.0938 24.3333C19.9364 24.3333 18.1875 22.4679 18.1875 20.1667C18.1875 17.8655 19.9364 16 22.0938 16C24.2511 16 26 17.8655 26 20.1667Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Albums
                    </a>
                </li>
            </ul>
            <div class="active-square" id="activeSquare"></div>
        </nav>
    </div>
</aside>

<div class="right">

    <div class="container-tabs">
        <div class="recherche">
                    <div class="text-field">
                        <img src="/Assets/icons/search.svg" alt="user"/>
                        <input type="text" placeholder="Ma recherche" value="">
                    </div>
            </div>
        <main>
            <section id="pagePrincipale" class="page">
                <header>
                    <h2>Menu principal</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="menu">
                    <button id="btnMenuArtistes" class="admin-content">
                        <svg width="29" height="29" viewBox="0 0 30 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.9866 21.7082H26.1667C27.7775 21.7082 29.1809 20.3606 28.6692 18.8332C27.8893 16.5055 25.9706 15.0979 22.5977 14.6103M18.146 9.84388C18.5703 9.97801 19.0564 10.0415 19.6042 10.0415C22.0347 10.0415 23.25 8.7915 23.25 5.6665C23.25 2.5415 22.0347 1.2915 19.6042 1.2915C19.0564 1.2915 18.5703 1.355 18.146 1.48913M10.8542 14.4165C16.6277 14.4165 19.4474 16.1838 20.1527 19.7183C20.3689 20.8015 19.4379 21.7082 18.3333 21.7082H3.375C2.27043 21.7082 1.33943 20.8015 1.5556 19.7183C2.26098 16.1838 5.08064 14.4165 10.8542 14.4165ZM10.8542 10.0415C13.2847 10.0415 14.5 8.7915 14.5 5.6665C14.5 2.5415 13.2847 1.2915 10.8542 1.2915C8.42361 1.2915 7.20833 2.5415 7.20833 5.6665C7.20833 8.7915 8.42361 10.0415 10.8542 10.0415Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Artistes</h3>
                            <p>Les artistes de l'application</p>
                        </div>
                    </button>
                    <button id="btnMenuSons" class="admin-content">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.75 14.5C5.75 11.2613 7.50962 8.43351 10.125 6.92059M23.25 14.2123C23.25 17.451 21.4904 20.2788 18.875 21.7917M27.625 14.5C27.625 21.7487 21.7487 27.625 14.5 27.625C7.25126 27.625 1.375 21.7487 1.375 14.5C1.375 7.25126 7.25126 1.375 14.5 1.375C21.7487 1.375 27.625 7.25126 27.625 14.5ZM17.4167 14.5C17.4167 16.1108 16.1108 17.4167 14.5 17.4167C12.8892 17.4167 11.5833 16.1108 11.5833 14.5C11.5833 12.8892 12.8892 11.5833 14.5 11.5833C16.1108 11.5833 17.4167 12.8892 17.4167 14.5Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Sons</h3>
                            <p>Les sons de l'application</p>
                        </div>
                    </button>
                    <button id="btnMenuGenres" class="admin-content">
                        <svg width="29" height="29" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.29175 7.04183H15.8751M1.29175 1.2085H15.8751M1.29175 12.8752H10.0417M15.8751 12.8752V18.7085L21.7084 15.7918L15.8751 12.8752Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Genres</h3>
                            <p>Les genres de l'application</p>
                        </div>
                    </button>
                    <button id="btnMenuUtilisateurs" class="admin-content">
                        <svg width="29" height="29" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="#FEFCE1" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="#FEFCE1" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Utilisateurs</h3>
                            <p>Les utilisateurs de l'application</p>
                        </div>
                    </button>
                    <button id="btnMenuPlaylists" class="admin-content">
                        <svg width="29" height="29" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 3C1 1.89543 1.89543 1 3 1H4C5.10457 1 6 1.89543 6 3V4C6 5.10457 5.10457 6 4 6H3C1.89543 6 1 5.10457 1 4V3Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 3C10 1.89543 10.8954 1 12 1H13C14.1046 1 15 1.89543 15 3V4C15 5.10457 14.1046 6 13 6H12C10.8954 6 10 5.10457 10 4V3Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1 12C1 10.8954 1.89543 10 3 10H4C5.10457 10 6 10.8954 6 12V13C6 14.1046 5.10457 15 4 15H3C1.89543 15 1 14.1046 1 13V12Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 12C10 10.8954 10.8954 10 12 10H13C14.1046 10 15 10.8954 15 12V13C15 14.1046 14.1046 15 13 15H12C10.8954 15 10 14.1046 10 13V12Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Playlists</h3>
                            <p>Les playlists de l'application</p>
                        </div>
                    </button>
                    <button id="btnMenuAlbums" class="admin-content">
                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="textes">
                            <h3>Albums</h3>
                            <p>Les albums de l'application</p>
                        </div>
                    </button>
                </div>
            </section>

            <section id="pageArtistes" class="page">
                <header>
                    <h2>Artistes</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tableArtistes">
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Image</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_artistes as $artiste) : ?>
                                <tr>
                                    <td><?= $artiste->getName() ?></td>
                                    <td><img src="data:image/jpeg;base64,<?= $artiste->getPicture() ?>" alt="<?= $artiste->getName() ?>"></td>
                                    <td>
                                        <button class="btn-consulterArtiste" id="btn-consulterArtiste"
                                        data-idArtiste="<?= $artiste->getId() ?>" 
                                        data-nomArtiste="<?= $artiste->getName() ?>" 
                                        data-imageArtiste="data:image/jpeg;base64,<?= $artiste->getPicture() ?>">Modifier</button>
                                        <button class="btn-supprimerArtiste" data-idArtiste="<?= $artiste->getId() ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterArtiste" >Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterArtiste" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=ajouter_artiste" enctype="multipart/form-data" method="post">
                            <input type="text" name="nom_nv_artiste" placeholder="Nom de l'artiste" required>
                            <input type="file" name="image_nv_artiste" accept="image/*">
                            <button type="submit" id="ajouterArtiste">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerArtiste" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_artiste" method="post">
                            <input type="hidden" name="id_artiste" id="id_artiste_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer cet artiste ?</p>
                            <button id="supprimerArtiste" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterArtiste" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_artiste" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_artiste" id="id_modif_artiste">
                            <input type="text" name="nom_artiste" id="nom_modif_artiste" placeholder="Nom de l'artiste" required>
                            <input type="file" name="image_artiste" id="image_modif_artiste" accept="image/*">
                            <button type="submit" id="modifierArtiste">Modifier</button>
                        </form>
                    </div>
                </div>

            </section>
            <section id="pageSons" class="page">
                <header>
                    <h2>Sons</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tableSons">
                        <thead>
                            <tr>
                                <td>Titre</td>
                                <td>Duree</td>
                                <td>Album</td>
                                <td>NbStream</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_sons as $son) : ?>
                                <tr>
                                    <td><?= $son->getTitre() ?></td>
                                    <td><?= $son->getDuree() ?></td>
                                    <?php $album = $albumDB->find($son->getIdAlbum()); ?>
                                    <td><?= $album->getTitre() ?></td>
                                    <td><?= $son->getNbStream() ?></td>
                                    <td>
                                        <button class="btn-consulterSon" id="btn-consulterSon"
                                        data-idSon="<?= $son->getId() ?>" 
                                        data-titreSon="<?= $son->getTitre() ?>" 
                                        data-dureeSon ="<?= $son->getDuree() ?>"
                                        data-mp3Son="<?= $son->getMp3() ?>" 
                                        data-albumSon="<?= $album->getTitre() ?>" 
                                        data-nbStreamSon="<?= $son->getNbStream() ?>">Modifier</button>
                                        <button class="btn-supprimerSon" id="btn-supprimerSon" data-idSon="<?= $son->getId() ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterSon">Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterSon" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=ajouter_son" method="post" enctype="multipart/form-data">
                            <input type="text" name="titre_nv_son" placeholder="Titre du son" required>
                            <input type="text" name="duree_nv_son" placeholder="Durée du son" required>
                            <input type="file" name="mp3_nv_son" accept="audio/*" required>
                            <select name="album_nv_son" id="album_nv_son" required>
                                <?php foreach ($liste_albums as $album) : ?>
                                    <option value="<?= $album->getId() ?>"><?= $album->getTitre() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="ajouterSon">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerSon" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_son" method="post">
                            <input type="hidden" name="id_son" id="id_son_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer ce son ?</p>
                            <button id="supprimerSon" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterSon" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_son" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_son" id="id_modif_son">
                            <input type="text" name="titre_son" id="titre_modif_son" placeholder="Titre du son" required>
                            <input type="text" name="duree_son" id="duree_modif_son" placeholder="Durée du son" required>
                            <input type="file" name="mp3_son" id="mp3_modif_son" accept="audio/*">
                            <select name="album_son" id="album_modif_son" required>
                                <?php foreach ($liste_albums as $album) : ?>
                                    <option value="<?= $album->getId() ?>"><?= $album->getTitre() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="modifierSon">Modifier</button>
                        </form>
                    </div>
                </div>
            </section>
            <section id="pageGenres" class="page">
                <header>
                    <h2>Genres</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tableGenres">
                        <thead>
                            <tr>
                                <td>Titre</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_genres as $genre) : ?>
                                <tr>
                                    <td><?= $genre->getTitre() ?></td>
                                    <td>
                                        <button class="btn-consulterGenre" id="btn-consulterGenre"
                                        data-idGenre="<?= $genre->getId() ?>" 
                                        data-titreGenre="<?= $genre->getTitre() ?>">Consulter</button>
                                        <button class="btn-supprimerGenre" id="btn-supprimerGenre" data-idGenre="<?= $genre->getId() ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterGenre">Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterGenre" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=ajouter_genre" method="post">
                            <input type="text" name="nom_nv_genre" placeholder="Nom du genre" required>
                            <button type="submit" id="ajouterGenre">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerGenre" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_genre" method="post">
                            <input type="hidden" name="id_genre" id="id_genre_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer ce genre ?</p>
                            <button id="supprimerGenre" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterGenre" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_genre" method="post">
                            <input type="hidden" name="id_genre" id="id_modif_genre">
                            <input type="text" name="titre_genre" id="titre_modif_genre" placeholder="Nom du genre" required>
                            <button type="submit" id="modifierGenre">Modifier</button>
                        </form>
                    </div>
                </div>
            </section>
            <section id="pageUtilisateurs" class="page">
                <header>
                    <h2>Utilisateurs</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tableUtilisateurs">
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Prenom</td>
                                <td>Pseudo</td>
                                <td>Email</td>
                                <td>Mot de passe</td>
                                <td>Statut</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_utilisateurs as $utilisateur) : ?>
                                <tr>
                                    <td><?= $utilisateur->getNom() ?></td>
                                    <td><?= $utilisateur->getPrenom() ?></td>
                                    <td><?= $utilisateur->getPseudo() ?></td>
                                    <td><?= $utilisateur->getEmail() ?></td>
                                    <td><?= $utilisateur->getMdp() ?></td>
                                    <td><?= $utilisateur->getStatut() ?></td>
                                    <td>
                                        <button class="btn-consulterUtilisateur" id="btn-consulterUtilisateur"
                                        data-idUtilisateur="<?= $utilisateur->getId() ?>"
                                        data-nomUtilisateur="<?= $utilisateur->getNom() ?>"
                                        data-prenomUtilisateur="<?= $utilisateur->getPrenom() ?>"
                                        data-pseudoUtilisateur="<?= $utilisateur->getPseudo() ?>"
                                        data-emailUtilisateur="<?= $utilisateur->getEmail() ?>"
                                        data-mdpUtilisateur="<?= $utilisateur->getMdp() ?>"
                                        data-statutUtilisateur="<?= $utilisateur->getStatut() ?>"
                                        >Consulter</button>
                                        <button class="btn-supprimerUtilisateur" id="btn-supprimerUtilisateur" data-idUtilisateur="<?= $utilisateur->getId() ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterUtilisateur">Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterUtilisateur" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form id="form-ajouterUtilisateur" action="index.php?action=ajouter_utilisateur" method="post">
                            <input type="text" name="nom_utilisateur" placeholder="Nom de l'utilisateur" required>
                            <input type="text" name="prenom_utilisateur" placeholder="Prenom de l'utilisateur" required>
                            <input type="text" name="pseudo_utilisateur" placeholder="Pseudo de l'utilisateur" required>
                            <input type="email" name="email_utilisateur" placeholder="Email de l'utilisateur" required>
                            <input type="text" name="mdp_utilisateur" placeholder="Mot de passe de l'utilisateur" required>
                            <select name="statut_utilisateur" id="statut_utilisateur">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                            <button type="submit" id="ajouterUtilisateur">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerUtilisateur" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_utilisateur" method="post">
                            <input type="hidden" name="id_utilisateur" id="id_utilisateur_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                            <button id="supprimerUtilisateur" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterUtilisateur" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_utilisateur" method="post">
                            <input type="hidden" name="id_utilisateur" id="id_modif_utilisateur">
                            <input type="text" name="nom_utilisateur" id="nom_modif_utilisateur" placeholder="Nom de l'utilisateur" required>
                            <input type="text" name="prenom_utilisateur" id="prenom_modif_utilisateur" placeholder="Prenom de l'utilisateur" required>
                            <input type="text" name="pseudo_utilisateur" id="pseudo_modif_utilisateur" placeholder="Pseudo de l'utilisateur" required>
                            <input type="email" name="email_utilisateur" id="email_modif_utilisateur" placeholder="Email de l'utilisateur" required>
                            <input type="password" name="mdp_utilisateur" id="mdp_modif_utilisateur" placeholder="Mot de passe de l'utilisateur" required>
                            <select name="statut_utilisateur" id="statut_modif_utilisateur">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                            <button type="submit" id="modifierUtilisateur">Modifier</button>
                        </form>
                    </div>
                </div>
            </section>
            <section id="pagePlaylists" class="page">
                <header>
                    <h2>Playlists</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tablePlaylists">
                        <thead>
                            <tr>
                                <td>Nom</td>
                                <td>Utilisateur</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_playlists as $playlist) : ?>
                                <tr>
                                    <td><?= $playlist->getTitre() ?></td>
                                    <td>
                                        <?php $utilisateur = $utilisateurDB->find($playlist->getIdUtilisateur()) ?>
                                        <?= $utilisateur->getPseudo() ?>
                                    </td>
                                    <td>
                                        <button class="btn-consulterPlaylist" id="btn-consulterPlaylist"
                                        data-idPlaylist="<?= $playlist->getId() ?>"
                                        data-nomPlaylist="<?= $playlist->getTitre() ?>"
                                        data-nomUtilisateur="<?= $playlist->getIdUtilisateur() ?>"
                                        >Consulter</button>
                                        <button class="btn-supprimerPlaylist" id="btn-supprimerPlaylist" data-idPlaylist="<?= $playlist->getId() ?>">Supprimer</button>
                                        <button class="btn-gererSonsPlaylist" id="btn-gererSonsPlaylist" data-idPlaylist="<?= $playlist->getId() ?>">Gérer les sons</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterPlaylist">Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterPlaylist" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=ajouter_playlist" method="post">
                            <input type="text" name="nom_nv_playlist" placeholder="Nom de la playlist" required>
                            <select name="nom_user_playlist" id="nom_nv_user">
                                <?php foreach ($liste_utilisateurs as $utilisateur) : ?>
                                    <option value="<?= $utilisateur->getId() ?>"><?= $utilisateur->getPseudo() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="ajouterPlaylist">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerPlaylist" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_playlist" method="post">
                            <input type="hidden" name="id_playlist" id="id_playlist_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer cette playlist ?</p>
                            <button id="supprimerPlaylist" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterPlaylist" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_playlist" method="post">
                            <input type="hidden" name="id_playlist" id="id_modif_playlist">
                            <input type="text" name="nom_playlist" id="nom_modif_playlist" placeholder="Nom de la playlist" required>
                            <select name="id_user" id="id_user">
                                <?php foreach ($liste_utilisateurs as $utilisateur) : ?>
                                    <option value="<?= $utilisateur->getId() ?>"><?= $utilisateur->getPseudo() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="modifierPlaylist">Modifier</button>
                        </form>
                    </div>
                </div>

                <div id="modal-gererSonsPlaylist" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=gerer_sons" method="post">
                            <input type="hidden" name="id_playlist" id="id_playlist_sons">
                            <?php
                            $listeSonsDansPlaylist = $playlistDB->getSons($playlist->getId());
                            $listeSonsPasDansPlaylist = $playlistDB->findAllSonsNotInPlaylist($playlist->getId());
                            ?>
                            <label for="sons_a_ajouter">Sons à ajouter dans la playlist</label>
                            <select name="sons_a_ajouter" id="son_ajoute">
                                <option value="0">Aucun</option>
                                <?php foreach ($listeSonsPasDansPlaylist as $son) : ?>
                                    <option value="<?= $son->getId() ?>"><?= $son->getTitre() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="sons_a_supprimer">Sons de la playlist à supprimer</label>
                            <select name="sons_a_supprimer" id="son_supprime">
                                <option value="0">Aucun</option>
                                <?php foreach ($listeSonsDansPlaylist as $son) : ?>
                                    <option value="<?= $son->getId() ?>"><?= $son->getTitre() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="gererPlaylist">Appliquer les changements</button>
                        </form>
                    </div>
                </div>
            </section>
                

            <section id="pageAlbums" class="page">
                <header>
                    <h2>Albums</h2>
                    <svg width="29" height="29" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.6118 9.82166L27.9072 14.9928C32.319 9.33028 28.353 1.28109 19.1767 0V9.98935C15.8932 3.95635 6.60488 3.25634 0.923272 9.82361L10.2961 14.8173C2.99181 14.4254 -2.30948 21.4977 1.01413 29.3226L10.8413 24.0871C6.34922 29.619 9.45097 38.5008 19.1746 39V28.1059C21.8685 34.7941 32.0717 37.0091 37.5188 29.3226L27.2966 23.8766C34.9199 25.066 42.0996 18.019 37.6118 9.82361V9.82166Z" fill="#E2FF08"/>
                    </svg>
                </header>
                <div class="table-container">
                    <table id="tableAlbums">
                        <thead>
                            <tr>
                                <td>Titre</td>
                                <td>Date</td>
                                <td>Cover</td>
                                <td>Artiste</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste_albums as $album) : ?>
                                <tr>
                                    <td><?= $album->getTitre() ?></td>
                                    <td><?= $album->getDate() ?></td>
                                    <td><img src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="<?= $album->getTitre() ?>"></td>
                                    <?php $nomArtiste = $artistDB->find($album->getIdArtiste()) ?>
                                    <td> <?= $nomArtiste->getName() ?></td>
                                    <td>
                                        <button class="btn-consulterAlbum" id="btn-consulterAlbum"
                                        data-idAlbum="<?= $album->getId() ?>"
                                        data-titreAlbum="<?= $album->getTitre() ?>"
                                        data-descriptionAlbum="<?= $album->getDescription() ?>"
                                        data-dateAlbum="<?= $album->getDate() ?>"
                                        data-coverAlbum="data:image/jpeg;base64,<?= $album->getCover() ?>"
                                        data-artisteAlbum="<?= $album->getIdArtiste() ?>">Modifier</button>
                                        <button class="btn-supprimerAlbum" id="btn-supprimerAlbum" data-idAlbum="<?= $album->getId() ?>">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button class="btn-ajouter" id="btn-ajouterAlbum">Ajouter</button>

                <!-- Modales -->
                <div id="modal-ajouterAlbum" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=ajouter_album" method="post" enctype="multipart/form-data">
                            <input type="text" name="titre_album" placeholder="Titre de l'album" required>
                            <input type="text" name="description_album" placeholder="Description de l'album" required>
                            <input type="text" name="date_album" placeholder="date de l'album" required>
                            <input type="file" name="cover_album" accept="image/*">
                            <select name="id_artiste" id="id_artiste">
                                <?php foreach ($liste_artistes as $artiste) : ?>
                                    <option value="<?= $artiste->getId() ?>"><?= $artiste->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="ajouterAlbum">Ajouter</button>
                        </form>
                    </div>
                </div>

                <div id="modal-supprimerAlbum" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=supprimer_album" method="post">
                            <input type="hidden" name="id_album" id="id_album_supprimer">
                            <p>Êtes-vous sûr de vouloir supprimer cet album ?</p>
                            <button id="supprimerAlbum" type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>

                <div id="modal-consulterAlbum" class="modal">
                    <div class="modal-content">
                        <span class="close-button">x</span>
                        <form action="index.php?action=modifier_album" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_album" id="id_modif_album">
                            <input type="text" name="titre_album" id="titre_modif_album" placeholder="Titre de l'album" required>
                            <input type="text" name="description_album" id="description_modif_album" placeholder="Description de l'album" required>
                            <input type="text" name="date_album" id="date_modif_album" required>
                            <input type="file" name="cover_album" id="cover_modif_album" accept="image/*">
                            <select name="id_artiste" id="id_artiste">
                                <?php foreach ($liste_artistes as $artiste) : ?>
                                    <option value="<?= $artiste->getId() ?>"><?= $artiste->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" id="modifierAlbum">Modifier</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
