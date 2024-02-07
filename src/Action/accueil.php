<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$albumDB = $manager->getAlbumDB();
$artistDB = $manager->getArtistDB();
$sonDB = $manager->getSonDB();
$sons = $sonDB->findEcouter($_SESSION['user']);
$likeSonDB = $manager->getLikeSonDB();
$likeAlbumDB = $manager->getLikeAlbumDB();
$likeArtisteDB = $manager->getLikeArtisteDB();

$albumAlea = $albumDB->getAleaAlbums();
$lastAlbum = $albumDB->getLastAlbums();
$artisteAlea = $artistDB->getAleaArtists();
$rechercheDB = $manager->getRechercheDB();

?>

    <div class="left">
        <header>
            <img class="logo" src="./Assets/images/logo.svg" alt="logo"/>
            <nav class="main-nav">
                <ul>
                    <li>
                        <a href="" id="goToAccueil">
                            <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3978 5.78855C15.7212 5.97943 15.9196 6.32699 15.9196 6.70251V16.3985C15.9196 16.9847 15.4445 17.4598 14.8583 17.4598H12.7357C12.1496 17.4598 11.6744 16.9847 11.6744 16.3985V12.1532C11.6744 10.3948 10.2489 8.96928 8.49047 8.96928C6.73204 8.96928 5.30655 10.3948 5.30655 12.1532V16.3985C5.30655 16.9847 4.83138 17.4598 4.24524 17.4598H2.12262C1.53647 17.4598 1.06131 16.9847 1.06131 16.3985V6.70251C1.06131 6.32699 1.25975 5.97943 1.58313 5.78855L7.95098 2.02974L7.41149 1.11578L7.95098 2.02974C8.28381 1.83328 8.69713 1.83328 9.02996 2.02974L15.3978 5.78855Z" fill="currentColor" stroke="currentColor" stroke-width="2.12262" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="" id="goToRecherche">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.2669 12.2669L19 19M7.6 14.2C11.2451 14.2 14.2 11.2451 14.2 7.6C14.2 3.95492 11.2451 1 7.6 1C3.95492 1 1 3.95492 1 7.6C1 11.2451 3.95492 14.2 7.6 14.2Z" stroke="currentColor" stroke-width="1.71429" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            <span>Rechercher</span>
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
                            <span>Mes playlists</span>
                        </a>
                    </li>
                </ul>
                <div class="active-square" id="activeSquare"></div>
            </nav>
        </header>
        <div class="container-tabs">
            <main id="SectionAccueil" class="tab">
                <section class="content-block">
                    <header>
                        <h2>Écoutés récemment <img src="./Assets/icons/star_1.svg"/></h2>
                        <a href="">Voir tout</a>
                    </header>
                    <section class="content">

                        <?php foreach ($sons as $son) : 
                            $album = $albumDB->findAlbum($son->getIdAlbum());
                            $artist = $artistDB->find($album->getIdArtiste());
                            $isLike = $likeSonDB->isLiked($son->getId(), $_SESSION['user_id']);
                            ?>

                            <div class="song-card topSon" data-id-song="<?= $son->getId() ?>">
                                <div class="background" aria-hidden></div>
                                <div class="container-image">
                                    <img class="cover" src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="cover du son">
                                    <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                </div>
                                <div class="bottom-content">
                                    <div class="texts">
                                        <h4><?= $son->getTitre() ?></h4>
                                        <h5><?= $artist->getName() ?></h5>
                                    </div>
                                    <?php if ($isLike) : ?>
                                        <svg class="svg-heart like likeSong" data-id-song="<?= $son->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php else : ?>
                                        <svg class="svg-heart likeSong" data-id-song="<?= $son->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
                </section>
                <section class="content-block">
                    <header>
                        <h2>Sorties récentes <img src="./Assets/icons/star_2.svg"/></h2>
                        <a href="">Voir tout</a>
                    </header>
                    <div class="content">

                        <?php foreach ($lastAlbum as $album) :
                            $artist = $artistDB->find($album->getIdArtiste());
                            $isLike = $likeAlbumDB->isLiked($album->getId(), $_SESSION['user_id']);
                            ?>
                            <div class="song-card playAlbum" data-id-album="<?= $album->getId() ?>">
                                <div class="background" aria-hidden></div>
                                <div class="container-image">
                                    <img class="cover" src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="cover du son">
                                    <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                </div>
                                <div class="bottom-content">
                                    <div class="texts">
                                        <h4><?= $album->getTitre() ?></h4>
                                        <h5><?= $artist->getName() ?>
                                    </div>
                                    <?php if ($isLike) : ?>
                                        <svg class="svg-heart like likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php else : ?>
                                        <svg class="svg-heart likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        </div>
                </section>
            </main>
            <main id="SectionRecherche" class="tab">

                <section id="PageArtiste">
                    <button class="back-btn" type="button" id="goBackToRecherche">
                        <img src="./Assets/icons/back-arrow.svg" alt="back-arrow">
                    </button>
                    <div class="infos-artiste">
                        <div class="card-artiste">
                            <div class="infos">
                                <div class="container-cover">
                                    <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                </div>
                                <div class="texts">
                                    <h2>So la lune</h2>
                                    <h4>7 800 000 auditeurs par mois</h4>
                                </div>
                            </div>
                            <img class="play-btn" src="./Assets/icons/play.svg" alt="play">
                        </div>
                        <div class="buttons">
                            <!-- bouton x titres likés et partager -->
                            <button class="btn like">
                                <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                    
                                5 titres likés
                            </button>
                            <button class="btn share">
                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.7441 13.4211C12.5876 13.7477 12.5 14.1136 12.5 14.5C12.5 15.8807 13.6193 17 15 17C16.3807 17 17.5 15.8807 17.5 14.5C17.5 13.1193 16.3807 12 15 12C14.0057 12 13.1469 12.5805 12.7441 13.4211ZM12.7441 13.4211L5.75586 10.0789M12.7441 4.57889C13.1469 5.41949 14.0057 6 15 6C16.3807 6 17.5 4.88071 17.5 3.5C17.5 2.11929 16.3807 1 15 1C13.6193 1 12.5 2.11929 12.5 3.5C12.5 3.88637 12.5876 4.25226 12.7441 4.57889ZM12.7441 4.57889L5.75586 7.92111M5.75586 7.92111C5.35311 7.08051 4.49435 6.5 3.5 6.5C2.11929 6.5 1 7.61929 1 9C1 10.3807 2.11929 11.5 3.5 11.5C4.49435 11.5 5.35311 10.9195 5.75586 10.0789M5.75586 7.92111C5.91235 8.24774 6 8.61363 6 9C6 9.38637 5.91235 9.75226 5.75586 10.0789" stroke="#9747FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                    
                                Partager
                            </button>
                        </div>
                    </div>
                    <div class="main-content">
                        <!-- onglets avec le même nav qu'avant sauf que cette fois ci on a que le choix entre Top titres et Albums-->
                        <nav>
                            <ul>
                                <li>
                                    <a href="" id="goToTopTitres">
                                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 14.5H18H9Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2.5H18H9Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 8.5H18H9Z" fill="currentColor"/>
                                            <path d="M9 14.5H18M1 10.5L1.94036 10.0298C2.57317 9.71342 3.33744 9.83744 3.83772 10.3377V10.3377C4.47963 10.9796 4.47963 12.0204 3.83772 12.6623L1 15.5H5M1.5 1H3V6M3 6H5M3 6H1M9 2.5H18M9 8.5H18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Top titres
                                    </a>
                                </li>
                                <li>
                                    <a href="" id="goToAlbums">
                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>                                            
                                        Albums
                                    </a>
                                </li>
                            </ul>
                            <div class="active-square" id="activeSquareArtiste"></div>
                        </nav>
                        <div class="content-block">
                            <section  id="TopTitres">
                                <div class="artiste-wrapper">
                                    <div class="artiste-row glass with-dots">
                                        <div class="infos">
                                            <div class="container-cover">
                                                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <ul>
                                            <li>
                                                <button>
                                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Consulter l'artiste
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter l'album
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Liker ce titre
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="artiste-wrapper">
                                    <div class="artiste-row glass with-dots">
                                        <div class="infos">
                                            <div class="container-cover">
                                                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <ul>
                                            <li>
                                                <button>
                                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Consulter l'artiste
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter l'album
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Liker ce titre
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="artiste-wrapper">
                                    <div class="artiste-row glass with-dots">
                                        <div class="infos">
                                            <div class="container-cover">
                                                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <ul>
                                            <li>
                                                <button>
                                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Consulter l'artiste
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter l'album
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Liker ce titre
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="artiste-wrapper">
                                    <div class="artiste-row glass with-dots">
                                        <div class="infos">
                                            <div class="container-cover">
                                                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <ul>
                                            <li>
                                                <button>
                                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Consulter l'artiste
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter l'album
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Liker ce titre
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="artiste-wrapper">
                                    <div class="artiste-row glass with-dots">
                                        <div class="infos">
                                            <div class="container-cover">
                                                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <ul>
                                            <li>
                                                <button>
                                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Consulter l'artiste
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter l'album
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>    
                                                    Consulter la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la file d'attente
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Ajouter à la playlist
                                                </button>
                                            </li>
                                            <li>
                                                <button>
                                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>                                                        
                                                    Liker ce titre
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <section id="Albums">
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                                        <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="./Assets/icons/heart.svg"/>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>
                </section>

                <div id="recherche" class="wrapper-recherche">
                    <div class="text-field">
                        <img src="./Assets/icons/search.svg" alt="user"/>
                        <input id="search" type="text" placeholder="Ma recherche" value="">
                    </div>
                    <section class="resultat">
                        <section id="MainResults" class="results-section">
                            <h2>Meilleurs résultats <img src="./Assets/icons/shape_1.svg"/></h2>
                            <div class="content">
                                <div id="bestResult" class="best-result glass">
                                    <div class="container-cover">
                                        <img class="no-result" id="cover-best-recherche" src="" alt="cover">
                                    </div>
                                    <div class="infos">
                                        <div class="texts">
                                            <h4 class="no-result" id="nom-best-recherche"></h4>
                                            <h5 class="no-result" id="type-best-recherche"></h5>
                                        </div>
                                        <img id="img-best-recherche" class="no-result expand" src="./assets/icons/expand.svg"/>
                                    </div>
                                </div>
                                <div class="other-results">
                                    <div class="artiste-wrapper" id="otherResults-1">
                                        <div class="artiste-row glass with-dots">
                                            <div class="infos">
                                                <div class="container-cover">
                                                    <img class="no-result" id="cover-best-recherche-2-1" src="" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4 class="no-result" id="nom-best-recherche-2-1"></h4>
                                                    <h5 class="no-result" id="type-best-recherche-2-1"></h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img id="img-best-recherche-2-1" class="menu-dots no-result" src="./assets/icons/menu-dots.svg" alt="open menu"/>
                                            </div>
                                        </div>
                                        <div class="menu">
                                            <ul>
                                                <li>
                                                    <button>
                                                        <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Consulter l'artiste
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter l'album
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la playlist
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Liker ce titre
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                
                                    <div class="artiste-wrapper" id="otherResults-2">
                                        <div class="artiste-row glass with-dots">
                                            <div class="infos">
                                                <div class="container-cover">
                                                    <img class="no-result" id="cover-best-recherche-2-2" src="" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4 class="no-result" id="nom-best-recherche-2-2"></h4>
                                                    <h5 class="no-result" id="type-best-recherche-2-2"></h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img id="img-best-recherche-2-2" class="menu-dots no-result" src="./assets/icons/menu-dots.svg" alt="open menu"/>
                                            </div>
                                        </div>
                                        <div class="menu">
                                            <ul>
                                                <li>
                                                    <button>
                                                        <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Consulter l'artiste
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter l'album
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la playlist
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Liker ce titre
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="artiste-wrapper" id="otherResults-3">
                                        <div class="artiste-row glass with-dots">
                                            <div class="infos">
                                                <div class="container-cover">
                                                    <img class="no-result" id="cover-best-recherche-2-3" src="" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4 class="no-result" id="nom-best-recherche-2-3"></h4>
                                                    <h5 class="no-result" id="type-best-recherche-2-3"></h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img id="img-best-recherche-2-3" class="menu-dots no-result" src="./assets/icons/menu-dots.svg" alt="open menu"/>
                                            </div>
                                        </div>
                                        <div class="menu">
                                            <ul>
                                                <li>
                                                    <button>
                                                        <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Consulter l'artiste
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter l'album
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>    
                                                        Consulter la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la file d'attente
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Ajouter à la playlist
                                                    </button>
                                                </li>
                                                <li>
                                                    <button>
                                                        <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>                                                        
                                                        Liker ce titre
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="OtherAlbums" class="results-section scrollable">
                            <h2>Autres albums <img src="/assets/icons/shape_2.svg"/></h2>
                            <div id="contentOtherAlbums" class="content" style="width: 1000px;">
                            </div>
                        </section>

                        <section id="OtherArtists" class="results-section scrollable">
                            <h2>Autres Artistes <img src="/assets/icons/shape_3.svg"/></h2>
                            <div id="contentOtherArtiste" class="content">
                            </div>
                        </section>
                    </section>
                </div>
            </main>


            <main id="SectionPlaylists" class="tab">
                <div class="left-content">
                    <div class="actions">
                        <div class="buttons">
                            <button class="btn like" type="submit" id="MesFavoris">
                                <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Mes favoris
                            </button>
                            <button class="btn playlist" type="submit" id="NouvellePlaylist">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                Nouvelle playlist
                            </button>
                        </div>
                        <div class="text-field">
                            <img src="./Assets/icons/search.svg" alt="user"/>
                            <input type="text" placeholder="Ma recherche" value="">
                        </div>
                    </div>
                    <div class="playlists">

                        <div class="artiste-wrapper">
                            <div id="btnPlaylist" class="artiste-row playlist glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>Super playlist</h4>
                                        <h5>So la lune, Luther, H JeuneCrack, AD Laurent, Sophie Anglade, AD Laurent, Sophie Anglade</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="menu">
                                <ul>
                                    <li>
                                        <button>
                                            <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                        
                                            Consulter l'artiste
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>    
                                            Consulter l'album
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1H17M3.99994 6H13.9999M7.99994 11H9.99994" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>    
                                            Consulter la file d'attente
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                        
                                            Ajouter à la file d'attente
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                        
                                            Ajouter à la playlist
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                        
                                            Liker ce titre
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <section class="current-display">

                    <div id="playlist" class="content-block">
                        <div class="playlist"></div>
                        <img src="./Assets/icons/menu-dots.svg" alt="open menu" class="menu-dots"/>
                        <div class="top-content">
                            <div class="album-infos">
                                <div class="container-album">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h3>Super playlist</h3>
                                        <h4>Durée: x heures</h4>
                                    </div>
                                </div>
                                <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                            </div>
                            <div class="buttons">
                                <button class="btn" type="button">
                                    <img src="./Assets/icons/add.svg" alt="arrow">    
                                    Ajouter un titre
                                </button>
                                <button class="btn" type="button">
                                    <img src="./Assets/icons/share.svg" alt="arrow">    
                                    Partager
                                </button>
                            </div>
                            <div class="border glass"></div>
                        </div>
                        <div class="songs">
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="favoris" class="content-block favoris">
                        <div class="top-content">
                            <div class="album-infos">
                                <div class="container-album">
                                    <svg class="heart" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>   
                                    <div class="texts">
                                        <h3>Mes favoris</h3>
                                        <h4>187 titres likés</h4>
                                    </div>
                                </div>
                                <img src="./Assets/icons/play.svg" alt="play" class="play"/>
                            </div>
                            <div class="border glass"></div>
                        </div>
                        <div class="songs">
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
            </main>
        
        
        </div>
    </div>

    <aside class="content-player">
        <div class="inner-content">
            <section class="top-content">
                <div class="cover-container">
                    <img id="cover" class="cover" src="./Assets/images/cover_so_la_lune.png"/>
                </div>
                <div class="media-infos">
                    <div class="current-media">
                        <div class="texts">
                            <h3 id="nom-song">Remontada</h3>
                            <h4 id="nom-artist">So la lune</h4>
                        </div>
                        <!-- <img class="heart" src="./Assets/icons/heart.svg"/> -->
                        <svg id="main-heart" class="svg-heart-main likeSong" data-id-song="-1" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="actions">
                        <div class="buttons">
                            <button type="button">
                                <img id="random" class="side-button" src="./Assets/icons/random.svg" alt="random"/>
                            </button>
                            <div class="main-buttons">
                                <button class="main-button" id="back" type="button">
                                    <img src="./Assets/icons/previous.svg" alt="previous"/>
                                </button>
                                <button id="playPause" type="button">
                                    <img id="imgPlayPause" src="./Assets/icons/play-lg.svg" alt="play"/>
                                </button>
                                <button class="main-button" id="next" type="button">
                                    <img src="./Assets/icons/next.svg" alt="next">
                                </button>
                            </div>
                            <button id="repeat" class="side-button" type="button">
                                <img src="./Assets/icons/repeat.svg" alt="repeat"/>
                            </button>
                        </div>
                        <div class="time-vol">
                            <div class="progress">
                                <p id="time0"></p>
                                <input type="range" class="bar" id="slider"/>
                                <p id="time1"></p>
                            </div>
                            <div class="volume isVolume lg">
                                <button class="isVolume btn-toggle-volume-bar">
                                    <svg class="isVolume" width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.7 17.4C21.3696 16.0676 21.8 14.5923 21.8 13C21.8 11.3858 21.3875 9.94613 20.7 8.6M24 20.7C25.3393 18.368 26.2 16.2959 26.2 13C26.2 9.70413 25.375 7.65538 24 5.3M27.3 24C29.3625 20.8375 30.6 17.7142 30.6 13C30.6 8.28581 29.3625 5.23125 27.3 2M7.3625 8.6H2.55C2.40413 8.6 2.26424 8.65795 2.16109 8.76109C2.05795 8.86424 2 9.00413 2 9.15V16.85C2 16.9959 2.05795 17.1358 2.16109 17.2389C2.26424 17.3421 2.40413 17.4 2.55 17.4H7.33844C7.59198 17.398 7.83837 17.484 8.03556 17.6434L14.3241 22.7921C14.406 22.8523 14.5029 22.8886 14.6042 22.8971C14.7055 22.9056 14.8071 22.8858 14.8978 22.84C14.9885 22.7942 15.0648 22.7242 15.1181 22.6377C15.1715 22.5512 15.1998 22.4516 15.2 22.35V3.65C15.1998 3.54838 15.1715 3.4488 15.1181 3.3623C15.0648 3.27581 14.9885 3.20578 14.8978 3.15999C14.8071 3.11421 14.7055 3.09445 14.6042 3.10291C14.5029 3.11137 14.406 3.14773 14.3241 3.20794L8.03556 8.35663C7.84746 8.5155 7.60871 8.60183 7.3625 8.6Z" stroke="#FEFCE1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <div class="volume-bar isVolume">
                                    <div class="bar-container isVolume">
                                        <input type="range" class="bar vertical isVolume" id="sliderVol"/>
                                    </div>
                                    <!-- si on clique sur le bouton volume du svg en dessous on est sensé mute le son: le svg du son mute c'est celui d'en dessous -->
                                    <!-- 
                                    <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M25.625 24.6875L2.25 1.3125" stroke="#FEFCE1" stroke-width="2.125" stroke-miterlimit="10" stroke-linecap="round"/>
                                        <path d="M12.875 5.09239V7.33692C12.8751 7.40716 12.9031 7.47449 12.9527 7.52419L14.5464 9.11794C14.5836 9.15509 14.6308 9.18041 14.6823 9.1907C14.7338 9.20098 14.7872 9.19578 14.8357 9.17574C14.8843 9.1557 14.9258 9.12173 14.955 9.07811C14.9843 9.03449 14.9999 8.98318 15 8.93067V4.00665C15.003 3.71269 14.9263 3.4234 14.7782 3.16947C14.6301 2.91554 14.416 2.70643 14.1586 2.56431C13.8934 2.42155 13.5931 2.35717 13.2926 2.37869C12.9922 2.40021 12.7041 2.50673 12.462 2.68583C12.4468 2.69637 12.4322 2.70768 12.4181 2.7197L10.2971 4.45622C10.2685 4.47975 10.245 4.50901 10.2284 4.54213C10.2117 4.57525 10.2022 4.61149 10.2004 4.64852C10.1985 4.68554 10.2045 4.72254 10.2179 4.75713C10.2312 4.79172 10.2516 4.82313 10.2779 4.84935L11.4101 5.98224C11.4568 6.0289 11.5191 6.05652 11.585 6.05971C11.651 6.0629 11.7157 6.04144 11.7667 5.9995L12.875 5.09239ZM12.875 20.9077L7.69066 16.663C7.31006 16.3539 6.83426 16.1859 6.34395 16.1875H2.25V9.81255H5.61813C5.67063 9.81246 5.72194 9.79681 5.76556 9.76757C5.80918 9.73834 5.84315 9.69683 5.86319 9.6483C5.88323 9.59976 5.88843 9.54637 5.87815 9.49488C5.86786 9.44339 5.84254 9.3961 5.80539 9.35899L4.21164 7.76524C4.16195 7.7156 4.09461 7.68767 4.02438 7.68755H1.71875C1.29606 7.68755 0.890685 7.85546 0.591799 8.15435C0.292913 8.45323 0.125 8.85861 0.125 9.2813V16.7188C0.125 17.1415 0.292913 17.5469 0.591799 17.8457C0.890685 18.1446 1.29606 18.3125 1.71875 18.3125H6.35125L12.4181 23.2797C12.4322 23.2918 12.4468 23.3031 12.462 23.3136C12.7071 23.4951 12.9994 23.6022 13.3038 23.6221C13.6081 23.642 13.9118 23.5739 14.1786 23.4258C14.4307 23.2823 14.6398 23.0739 14.7842 22.8222C14.9287 22.5706 15.0032 22.2849 15 21.9948V18.6632C14.9999 18.5929 14.9719 18.5256 14.9223 18.4759L13.3286 16.8822C13.2914 16.845 13.2442 16.8197 13.1927 16.8094C13.1412 16.7991 13.0878 16.8043 13.0393 16.8244C12.9907 16.8444 12.9492 16.8784 12.92 16.922C12.8907 16.9656 12.8751 17.0169 12.875 17.0694V20.9077ZM21.375 13C21.375 11.3691 20.9892 9.82052 20.1963 8.26728C20.0653 8.02158 19.843 7.83715 19.5774 7.75365C19.3118 7.67015 19.024 7.69427 18.7759 7.82081C18.5279 7.94735 18.3394 8.1662 18.2511 8.43027C18.1628 8.69434 18.1817 8.98253 18.3037 9.23282C18.9405 10.4806 19.25 11.7131 19.25 13C19.25 13.1771 19.2431 13.3571 19.2294 13.5399C19.2237 13.6161 19.2346 13.6926 19.2612 13.7643C19.2877 13.8359 19.3295 13.9009 19.3835 13.955L20.689 15.2612C20.7228 15.2951 20.7652 15.3193 20.8116 15.3312C20.858 15.343 20.9068 15.3421 20.9528 15.3285C20.9987 15.3149 21.0401 15.2891 21.0726 15.2539C21.1051 15.2186 21.1274 15.1753 21.1373 15.1284C21.2944 14.4298 21.3741 13.7161 21.375 13ZM25.625 13C25.625 9.60071 24.7564 7.42923 23.3552 5.02731C23.2113 4.78785 22.9789 4.61469 22.7083 4.54534C22.4376 4.47599 22.1506 4.51602 21.9092 4.65677C21.6679 4.79752 21.4917 5.02766 21.4188 5.29736C21.3459 5.56706 21.3822 5.85462 21.5198 6.09778C22.7742 8.24802 23.5 10.0669 23.5 13C23.5 14.5825 23.2815 15.8475 22.8778 17.0276C22.8453 17.1217 22.8399 17.223 22.8623 17.3199C22.8846 17.4169 22.9337 17.5057 23.0039 17.5761L24.1176 18.6891C24.1483 18.72 24.1862 18.7428 24.2279 18.7556C24.2696 18.7683 24.3138 18.7707 24.3565 18.7623C24.3993 18.754 24.4394 18.7353 24.4732 18.7078C24.5071 18.6803 24.5336 18.6449 24.5505 18.6047C25.2325 16.9765 25.625 15.2519 25.625 13Z" fill="#FEFCE1"/>
                                        <path d="M29.875 13.0001C29.875 8.06874 28.5343 4.9576 26.5208 1.80331C26.3692 1.56554 26.1293 1.39776 25.8539 1.33686C25.5786 1.27596 25.2903 1.32694 25.0526 1.47858C24.8148 1.63022 24.647 1.8701 24.5861 2.14545C24.5252 2.4208 24.5762 2.70906 24.7278 2.94682C26.5427 5.78702 27.75 8.58405 27.75 13.0001C27.75 16.151 27.159 18.4533 26.1835 20.504C26.1597 20.5534 26.1519 20.6091 26.1611 20.6632C26.1702 20.7173 26.1959 20.7672 26.2346 20.8061L27.418 21.9908C27.4475 22.0206 27.4838 22.0429 27.5236 22.056C27.5635 22.0691 27.6059 22.0725 27.6474 22.066C27.6889 22.0596 27.7282 22.0433 27.7622 22.0187C27.7962 21.9941 27.8239 21.9618 27.843 21.9244C29.2694 19.124 29.875 16.3868 29.875 13.0001Z" fill="#FEFCE1"/>
                                    </svg>
                                    -->
                                    <svg class="isVolume" width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.7 17.4C21.3696 16.0676 21.8 14.5923 21.8 13C21.8 11.3858 21.3875 9.94613 20.7 8.6M24 20.7C25.3393 18.368 26.2 16.2959 26.2 13C26.2 9.70413 25.375 7.65538 24 5.3M27.3 24C29.3625 20.8375 30.6 17.7142 30.6 13C30.6 8.28581 29.3625 5.23125 27.3 2M7.3625 8.6H2.55C2.40413 8.6 2.26424 8.65795 2.16109 8.76109C2.05795 8.86424 2 9.00413 2 9.15V16.85C2 16.9959 2.05795 17.1358 2.16109 17.2389C2.26424 17.3421 2.40413 17.4 2.55 17.4H7.33844C7.59198 17.398 7.83837 17.484 8.03556 17.6434L14.3241 22.7921C14.406 22.8523 14.5029 22.8886 14.6042 22.8971C14.7055 22.9056 14.8071 22.8858 14.8978 22.84C14.9885 22.7942 15.0648 22.7242 15.1181 22.6377C15.1715 22.5512 15.1998 22.4516 15.2 22.35V3.65C15.1998 3.54838 15.1715 3.4488 15.1181 3.3623C15.0648 3.27581 14.9885 3.20578 14.8978 3.15999C14.8071 3.11421 14.7055 3.09445 14.6042 3.10291C14.5029 3.11137 14.406 3.14773 14.3241 3.20794L8.03556 8.35663C7.84746 8.5155 7.60871 8.60183 7.3625 8.6Z" stroke="#FEFCE1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-sm-display">
                        <button id="btnAfficheFileAttente">
                            <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 9.42857H20.5714M2 2H20.5714M2 16.8571H13.1429M20.5714 16.8571V24.2857L28 20.5714L20.5714 16.8571Z" stroke="#FEFCE1" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="volume isVolume sm">
                            <button class="isVolume btn-toggle-volume-bar">
                                <svg class="isVolume" width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.7 17.4C21.3696 16.0676 21.8 14.5923 21.8 13C21.8 11.3858 21.3875 9.94613 20.7 8.6M24 20.7C25.3393 18.368 26.2 16.2959 26.2 13C26.2 9.70413 25.375 7.65538 24 5.3M27.3 24C29.3625 20.8375 30.6 17.7142 30.6 13C30.6 8.28581 29.3625 5.23125 27.3 2M7.3625 8.6H2.55C2.40413 8.6 2.26424 8.65795 2.16109 8.76109C2.05795 8.86424 2 9.00413 2 9.15V16.85C2 16.9959 2.05795 17.1358 2.16109 17.2389C2.26424 17.3421 2.40413 17.4 2.55 17.4H7.33844C7.59198 17.398 7.83837 17.484 8.03556 17.6434L14.3241 22.7921C14.406 22.8523 14.5029 22.8886 14.6042 22.8971C14.7055 22.9056 14.8071 22.8858 14.8978 22.84C14.9885 22.7942 15.0648 22.7242 15.1181 22.6377C15.1715 22.5512 15.1998 22.4516 15.2 22.35V3.65C15.1998 3.54838 15.1715 3.4488 15.1181 3.3623C15.0648 3.27581 14.9885 3.20578 14.8978 3.15999C14.8071 3.11421 14.7055 3.09445 14.6042 3.10291C14.5029 3.11137 14.406 3.14773 14.3241 3.20794L8.03556 8.35663C7.84746 8.5155 7.60871 8.60183 7.3625 8.6Z" stroke="#FEFCE1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <div class="volume-bar isVolume">
                                <div class="bar-container isVolume">
                                    <input type="range" class="bar vertical isVolume" id="sliderVol"/>
                                </div>
                                <!-- si on clique sur le bouton volume du svg en dessous on est sensé mute le son: le svg du son mute c'est celui d'en dessous -->
                                <!-- 
                                <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25.625 24.6875L2.25 1.3125" stroke="#FEFCE1" stroke-width="2.125" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M12.875 5.09239V7.33692C12.8751 7.40716 12.9031 7.47449 12.9527 7.52419L14.5464 9.11794C14.5836 9.15509 14.6308 9.18041 14.6823 9.1907C14.7338 9.20098 14.7872 9.19578 14.8357 9.17574C14.8843 9.1557 14.9258 9.12173 14.955 9.07811C14.9843 9.03449 14.9999 8.98318 15 8.93067V4.00665C15.003 3.71269 14.9263 3.4234 14.7782 3.16947C14.6301 2.91554 14.416 2.70643 14.1586 2.56431C13.8934 2.42155 13.5931 2.35717 13.2926 2.37869C12.9922 2.40021 12.7041 2.50673 12.462 2.68583C12.4468 2.69637 12.4322 2.70768 12.4181 2.7197L10.2971 4.45622C10.2685 4.47975 10.245 4.50901 10.2284 4.54213C10.2117 4.57525 10.2022 4.61149 10.2004 4.64852C10.1985 4.68554 10.2045 4.72254 10.2179 4.75713C10.2312 4.79172 10.2516 4.82313 10.2779 4.84935L11.4101 5.98224C11.4568 6.0289 11.5191 6.05652 11.585 6.05971C11.651 6.0629 11.7157 6.04144 11.7667 5.9995L12.875 5.09239ZM12.875 20.9077L7.69066 16.663C7.31006 16.3539 6.83426 16.1859 6.34395 16.1875H2.25V9.81255H5.61813C5.67063 9.81246 5.72194 9.79681 5.76556 9.76757C5.80918 9.73834 5.84315 9.69683 5.86319 9.6483C5.88323 9.59976 5.88843 9.54637 5.87815 9.49488C5.86786 9.44339 5.84254 9.3961 5.80539 9.35899L4.21164 7.76524C4.16195 7.7156 4.09461 7.68767 4.02438 7.68755H1.71875C1.29606 7.68755 0.890685 7.85546 0.591799 8.15435C0.292913 8.45323 0.125 8.85861 0.125 9.2813V16.7188C0.125 17.1415 0.292913 17.5469 0.591799 17.8457C0.890685 18.1446 1.29606 18.3125 1.71875 18.3125H6.35125L12.4181 23.2797C12.4322 23.2918 12.4468 23.3031 12.462 23.3136C12.7071 23.4951 12.9994 23.6022 13.3038 23.6221C13.6081 23.642 13.9118 23.5739 14.1786 23.4258C14.4307 23.2823 14.6398 23.0739 14.7842 22.8222C14.9287 22.5706 15.0032 22.2849 15 21.9948V18.6632C14.9999 18.5929 14.9719 18.5256 14.9223 18.4759L13.3286 16.8822C13.2914 16.845 13.2442 16.8197 13.1927 16.8094C13.1412 16.7991 13.0878 16.8043 13.0393 16.8244C12.9907 16.8444 12.9492 16.8784 12.92 16.922C12.8907 16.9656 12.8751 17.0169 12.875 17.0694V20.9077ZM21.375 13C21.375 11.3691 20.9892 9.82052 20.1963 8.26728C20.0653 8.02158 19.843 7.83715 19.5774 7.75365C19.3118 7.67015 19.024 7.69427 18.7759 7.82081C18.5279 7.94735 18.3394 8.1662 18.2511 8.43027C18.1628 8.69434 18.1817 8.98253 18.3037 9.23282C18.9405 10.4806 19.25 11.7131 19.25 13C19.25 13.1771 19.2431 13.3571 19.2294 13.5399C19.2237 13.6161 19.2346 13.6926 19.2612 13.7643C19.2877 13.8359 19.3295 13.9009 19.3835 13.955L20.689 15.2612C20.7228 15.2951 20.7652 15.3193 20.8116 15.3312C20.858 15.343 20.9068 15.3421 20.9528 15.3285C20.9987 15.3149 21.0401 15.2891 21.0726 15.2539C21.1051 15.2186 21.1274 15.1753 21.1373 15.1284C21.2944 14.4298 21.3741 13.7161 21.375 13ZM25.625 13C25.625 9.60071 24.7564 7.42923 23.3552 5.02731C23.2113 4.78785 22.9789 4.61469 22.7083 4.54534C22.4376 4.47599 22.1506 4.51602 21.9092 4.65677C21.6679 4.79752 21.4917 5.02766 21.4188 5.29736C21.3459 5.56706 21.3822 5.85462 21.5198 6.09778C22.7742 8.24802 23.5 10.0669 23.5 13C23.5 14.5825 23.2815 15.8475 22.8778 17.0276C22.8453 17.1217 22.8399 17.223 22.8623 17.3199C22.8846 17.4169 22.9337 17.5057 23.0039 17.5761L24.1176 18.6891C24.1483 18.72 24.1862 18.7428 24.2279 18.7556C24.2696 18.7683 24.3138 18.7707 24.3565 18.7623C24.3993 18.754 24.4394 18.7353 24.4732 18.7078C24.5071 18.6803 24.5336 18.6449 24.5505 18.6047C25.2325 16.9765 25.625 15.2519 25.625 13Z" fill="#FEFCE1"/>
                                    <path d="M29.875 13.0001C29.875 8.06874 28.5343 4.9576 26.5208 1.80331C26.3692 1.56554 26.1293 1.39776 25.8539 1.33686C25.5786 1.27596 25.2903 1.32694 25.0526 1.47858C24.8148 1.63022 24.647 1.8701 24.5861 2.14545C24.5252 2.4208 24.5762 2.70906 24.7278 2.94682C26.5427 5.78702 27.75 8.58405 27.75 13.0001C27.75 16.151 27.159 18.4533 26.1835 20.504C26.1597 20.5534 26.1519 20.6091 26.1611 20.6632C26.1702 20.7173 26.1959 20.7672 26.2346 20.8061L27.418 21.9908C27.4475 22.0206 27.4838 22.0429 27.5236 22.056C27.5635 22.0691 27.6059 22.0725 27.6474 22.066C27.6889 22.0596 27.7282 22.0433 27.7622 22.0187C27.7962 21.9941 27.8239 21.9618 27.843 21.9244C29.2694 19.124 29.875 16.3868 29.875 13.0001Z" fill="#FEFCE1"/>
                                </svg>
                                -->
                                <svg class="isVolume" width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.7 17.4C21.3696 16.0676 21.8 14.5923 21.8 13C21.8 11.3858 21.3875 9.94613 20.7 8.6M24 20.7C25.3393 18.368 26.2 16.2959 26.2 13C26.2 9.70413 25.375 7.65538 24 5.3M27.3 24C29.3625 20.8375 30.6 17.7142 30.6 13C30.6 8.28581 29.3625 5.23125 27.3 2M7.3625 8.6H2.55C2.40413 8.6 2.26424 8.65795 2.16109 8.76109C2.05795 8.86424 2 9.00413 2 9.15V16.85C2 16.9959 2.05795 17.1358 2.16109 17.2389C2.26424 17.3421 2.40413 17.4 2.55 17.4H7.33844C7.59198 17.398 7.83837 17.484 8.03556 17.6434L14.3241 22.7921C14.406 22.8523 14.5029 22.8886 14.6042 22.8971C14.7055 22.9056 14.8071 22.8858 14.8978 22.84C14.9885 22.7942 15.0648 22.7242 15.1181 22.6377C15.1715 22.5512 15.1998 22.4516 15.2 22.35V3.65C15.1998 3.54838 15.1715 3.4488 15.1181 3.3623C15.0648 3.27581 14.9885 3.20578 14.8978 3.15999C14.8071 3.11421 14.7055 3.09445 14.6042 3.10291C14.5029 3.11137 14.406 3.14773 14.3241 3.20794L8.03556 8.35663C7.84746 8.5155 7.60871 8.60183 7.3625 8.6Z" stroke="#FEFCE1" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="file-attente">
                <h4>A suivre</h4>
                <div class="content" id="content-file">


                </div>
            </section>
        </div>
    </aside>

    <div class="pop-up-container" id="popUpContainer">
        <div class="new-playlist" id="popUpPlaylist">
            <header>
                <h2>Nouvelle playlist <img src="./Assets/icons/shape_1.svg"/></h2>
                <button id="btnClosePopUp" type="button">
                    <img src="./Assets/icons/close.svg" alt="close"/>
                </button>
            </header>
            <form>

                <div class="top-content">
                    <div class="container-cover">
                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover"/>
                    </div>
                    <div class="text-field">
                        <img src="./Assets/icons/pencil.svg" alt="user"/>
                        <input type="text" placeholder="Playlist n°1" value="Playlist n°1">
                    </div>
                </div>
                <div class="bottom-content">
                    <div class="left-content">
                        <h3>Suggestions</h3>
                        <div class="suggestions">
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="./Assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <button class="btn playlist important">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>    
                        Ajouter la playlist
                    </button>
                </div>

            </form>
        </div>
    </div>
