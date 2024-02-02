<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$albumDB = $manager->getAlbumDB();
$artistDB = $manager->getArtistDB();
$son = $manager->getSonDB();
$sons = $son->findEcouter($_SESSION['user']);


$albumAlea = $albumDB->getAleaAlbums();
$lastAlbum = $albumDB->getLastAlbums();


?>

    <div class="left">
        <header>
            <img class="logo" src="/Assets/images/logo.svg" alt="logo"/>
            <nav>
                <ul>
                    <li>
                        <a href="" id="goToAccueil">
                            <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3978 5.78855C15.7212 5.97943 15.9196 6.32699 15.9196 6.70251V16.3985C15.9196 16.9847 15.4445 17.4598 14.8583 17.4598H12.7357C12.1496 17.4598 11.6744 16.9847 11.6744 16.3985V12.1532C11.6744 10.3948 10.2489 8.96928 8.49047 8.96928C6.73204 8.96928 5.30655 10.3948 5.30655 12.1532V16.3985C5.30655 16.9847 4.83138 17.4598 4.24524 17.4598H2.12262C1.53647 17.4598 1.06131 16.9847 1.06131 16.3985V6.70251C1.06131 6.32699 1.25975 5.97943 1.58313 5.78855L7.95098 2.02974L7.41149 1.11578L7.95098 2.02974C8.28381 1.83328 8.69713 1.83328 9.02996 2.02974L15.3978 5.78855Z" fill="currentColor" stroke="currentColor" stroke-width="2.12262" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="" id="goToRecherche">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.2669 12.2669L19 19M7.6 14.2C11.2451 14.2 14.2 11.2451 14.2 7.6C14.2 3.95492 11.2451 1 7.6 1C3.95492 1 1 3.95492 1 7.6C1 11.2451 3.95492 14.2 7.6 14.2Z" stroke="currentColor" stroke-width="1.71429" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Rechercher
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
                            Mes playlists
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
                        <h2>Écoutés récemment <img src="/assets/icons/star_1.svg"/></h2>
                        <a href="">Voir tout</a>
                    </header>
                    <section class="content">

                        <?php foreach ($sons as $son) : 
                            $album = $albumDB->findAlbum($son->getIdAlbum());
                            $artist = $artistDB->find($album->getIdArtiste());
                            ?>

                            <div class="song-card topSon" data-id-song="<?= $son->getId() ?>">
                                <div class="background" aria-hidden></div>
                                <div class="container-image">
                                    <img class="cover" src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="cover du son">
                                    <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                </div>
                                <div class="bottom-content">
                                    <div class="texts">
                                        <h4><?= $son->getTitre() ?></h4>
                                        <h5><?= $artist->getName() ?></h5>
                                    </div>
                                    <img class="heart" src="/assets/icons/heart.svg"/>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
                </section>
                <section class="content-block">
                    <header>
                        <h2>Sorties récentes <img src="/assets/icons/star_2.svg"/></h2>
                        <a href="">Voir tout</a>
                    </header>
                    <div class="content">

                        <?php foreach ($lastAlbum as $album) :
                            $artist = $artistDB->find($album->getIdArtiste());
                            ?>
                            <div class="song-card playAlbum" data-id-album="<?= $album->getId() ?>">
                                <div class="background" aria-hidden></div>
                                <div class="container-image">
                                    <img class="cover" src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="cover du son">
                                    <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                </div>
                                <div class="bottom-content">
                                    <div class="texts">
                                        <h4><?= $album->getTitre() ?></h4>
                                        <h5><?= $artist->getName() ?>
                                    </div>
                                    <img class="heart" src="/assets/icons/heart.svg"/>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        </div>
                    </div>
                </section>
            </main>
            <main id="SectionRecherche" class="tab">

                <section id="PageArtiste">
                    <button class="back-btn" type="button" id="goBackToRecherche">
                        <img src="/Assets/icons/back-arrow.svg" alt="back-arrow">
                    </button>
                    <div class="infos-artiste">
                        <div class="card-artiste">
                            <div class="infos">
                                <div class="container-cover">
                                    <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                </div>
                                <div class="texts">
                                    <h2>So la lune</h2>
                                    <h4>7 800 000 auditeurs par mois</h4>
                                </div>
                            </div>
                            <img class="play-btn" src="/assets/icons/play.svg" alt="play">
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
                                                <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                            </div>
                                            <div class="texts">
                                                <h4>L'enfant de la pluie</h4>
                                                <h5>So la lune</h5>
                                            </div>
                                        </div>
                                        <div class="actions">
                                        <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>
                                <div class="song-card">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                        <img src="/assets/icons/play.svg" alt="play" class="play"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>Remontada</h4>
                                            <h5>So la lune</h5>
                                        </div>
                                        <img class="heart" src="/assets/icons/heart.svg"/>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>
                </section>

                <div id="recherche" class="wrapper-recherche">
                    <div class="text-field">
                        <img src="/Assets/icons/search.svg" alt="user"/>
                        <input type="text" placeholder="Ma recherche" value="">
                    </div>
                    <section class="resultat">
                        <!-- l'idée là c'est de montrer à gauche le résultat le plus
                            pertinent.
                            Exemple: si on tape ga: on s'attend à avoir gazo en truc le plus pertinent
                            puis du coup si on à un artiste à gauche: on met ses 3 titres les plus connus à droite.

                            Si le résultat le plus pertinent à gauche c'est un titre, on l'affiche à gauche
                            et à droite on va mettre d'autres résultats qui peuvent être intéressants 
                            en fonction de la recherche

                            si le résultat le plus pertinent à gauche c'est un album, on l'affiche à gauche
                            à droite on met les 3 titres de l'album les plus connus
                        -->
                        <!--
                            et en dessous on va faire un listing à l'horizontal de 5 albums/titres max qui peuvent correspondre à la recherche

                            En dessous on va faire un listing à l'horizontal de 5 artistes max qui peuvent correspondre à la recherche
                        -->
                        <section id="MainResults" class="results-section">
                            <h2>Meilleurs résultats <img src="/assets/icons/shape_1.svg"/></h2>
                            <div class="content">
                                <div id="bestResult" class="best-result glass">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="infos">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                        <img src="/assets/icons/expand.svg"/>
                                    </div>
                                </div>
                                <div class="other-results">
                                    <div class="artiste-wrapper">
                                        <div class="artiste-row glass with-dots">
                                            <div class="infos">
                                                <div class="container-cover">
                                                    <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4>L'enfant de la pluie</h4>
                                                    <h5>So la lune</h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                    <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4>L'enfant de la pluie</h4>
                                                    <h5>So la lune</h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                                    <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                                </div>
                                                <div class="texts">
                                                    <h4>L'enfant de la pluie</h4>
                                                    <h5>So la lune</h5>
                                                </div>
                                            </div>
                                            <div class="actions">
                                            <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                            <div class="content">
                                <?php foreach ($albumAlea as $album) : 
                                    $artist = $artistDB->find($album->getIdArtiste());
                                ?>
                                    <div class="song-card playAlbum" data-id-album="<?= $album->getId() ?>">
                                        <div class="background" aria-hidden="true"></div>
                                        <div class="container-image">
                                            <img class="cover" src="data:image/jpeg;base64, <?= $album->getCover() ?>" alt="cover"/>
                                            <img src="/Assets/icons/play.svg" alt="play" class="play"/>
                                        </div>
                                        <div class="bottom-content">
                                            <div class="texts">
                                                <h4><?= $album->getTitre() ?></h4>
                                                <h5><?= $artist->getName() ?></h5>
                                            </div>
                                            <img class="heart" src="/assets/icons/heart.svg" alt="heart"/>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </section>

                        <section id="OtherArtists" class="results-section scrollable">
                            <h2>Autres Artistes <img src="/assets/icons/shape_3.svg"/></h2>
                            <div class="content">
                                <div class="song-card artiste">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="song-card artiste">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="song-card artiste">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="song-card artiste">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="song-card artiste">
                                    <div class="background" aria-hidden></div>
                                    <div class="container-image">
                                        <img class="cover" src="/assets/images/cover_so_la_lune.png"/>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="texts">
                                            <h4>So la lune</h4>
                                            <h5>Artiste</h5>
                                        </div>
                                    </div>
                                </div>
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
                            <img src="/Assets/icons/search.svg" alt="user"/>
                            <input type="text" placeholder="Ma recherche" value="">
                        </div>
                    </div>
                    <div class="playlists">

                        <div class="artiste-wrapper">
                            <div id="btnPlaylist" class="artiste-row playlist glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>Super playlist</h4>
                                        <h5>So la lune, Luther, H JeuneCrack, AD Laurent, Sophie Anglade, AD Laurent, Sophie Anglade</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                   <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                        <img src="/assets/icons/menu-dots.svg" alt="open menu" class="menu-dots"/>
                        <div class="top-content">
                            <div class="album-infos">
                                <div class="container-album">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h3>Super playlist</h3>
                                        <h4>Durée: x heures</h4>
                                    </div>
                                </div>
                                <img src="/assets/icons/play.svg" alt="play" class="play"/>
                            </div>
                            <div class="buttons">
                                <button class="btn" type="button">
                                    <img src="/assets/icons/add.svg" alt="arrow">    
                                    Ajouter un titre
                                </button>
                                <button class="btn" type="button">
                                    <img src="/assets/icons/share.svg" alt="arrow">    
                                    Partager
                                </button>
                            </div>
                            <div class="border glass"></div>
                        </div>
                        <div class="songs">
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                                <img src="/assets/icons/play.svg" alt="play" class="play"/>
                            </div>
                            <div class="border glass"></div>
                        </div>
                        <div class="songs">
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass with-dots">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
                                </div>
                            </div>
                            <div class="artiste-row glass">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img class="menu-dots" src="/assets/icons/menu-dots.svg" alt="open menu"/>
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
                     <img id="cover" class="cover" src="/assets/images/cover_so_la_lune.png"/>
                 </div>
                 <div class="media-infos">
                     <div class="current-media">
                         <div class="texts">
                             <h3 id="nom-song">Remontada</h3>
                             <h4 id="nom-artist">So la lune</h4>
                         </div>
                         <img src="/assets/icons/heart.svg"/>
                     </div>
                     <div class="actions">
                         <div class="buttons">
                             <button type="button">
                                 <img src="/assets/icons/random.svg" alt="random"/>
                             </button>
                             <div class="main-buttons">
                                 <button type="button" id="nextL">
                                     <img src="/assets/icons/previous.svg" alt="previous"/>
                                 </button>
                                 <button id="pause" type="button">
                                     <img src="/assets/icons/play-lg.svg" alt="play"/>
                                 </button>
                                 <button type="button" id="nextR">
                                     <img src="/assets/icons/next.svg" alt="next">
                                 </button>
                             </div>
                             <button type="button">
                                 <img src="/assets/icons/repeat.svg" alt="repeat"/>
                             </button>
                         </div>
                         <div class="progress">
                             <p id="time0"></p>
                             <input type="range" class="bar" id="slider">
                                 <div class="inner"></div>
                             </input>
                             <p id="time1"></p>
                         </div>
                     </div>
                 </div>
             </section>
             <section class="file-attente">
                 <h4>A suivre</h4>
                 <div class="content">
                     <div class="artiste-row glass">
                         <div class="infos">
                             <div class="container-cover">
                                 <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                             </div>
                             <div class="texts">
                                 <h4>L'enfant de la pluie</h4>
                                 <h5>So la lune</h5>
                             </div>
                         </div>
                         <div class="actions">
                             <div class="edit-list">
                                 <img src="/assets/icons/down-arrow.svg" alt="down"/>
                                 <img src="/assets/icons/up-arrow.svg" alt="up"/>
                             </div>
                             <img src="/assets/icons/close.svg"/>
                         </div>
                     </div>
                     <div class="artiste-row glass">
                         <div class="infos">
                             <div class="container-cover">
                                 <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                             </div>
                             <div class="texts">
                                 <h4>L'enfant de la pluie</h4>
                                 <h5>So la lune</h5>
                             </div>
                         </div>
                         <div class="actions">
                             <div class="edit-list">
                                 <img src="/assets/icons/down-arrow.svg" alt="down"/>
                                 <img src="/assets/icons/up-arrow.svg" alt="up"/>
                             </div>
                             <img src="/assets/icons/close.svg"/>
                         </div>
                     </div>
                     <div class="artiste-row glass">
                         <div class="infos">
                             <div class="container-cover">
                                 <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                             </div>
                             <div class="texts">
                                 <h4>L'enfant de la pluie</h4>
                                 <h5>So la lune</h5>
                             </div>
                         </div>
                         <div class="actions">
                             <div class="edit-list">
                                 <img src="/assets/icons/down-arrow.svg" alt="down"/>
                                 <img src="/assets/icons/up-arrow.svg" alt="up"/>
                             </div>
                             <img src="/assets/icons/close.svg"/>
                         </div>
                     </div>
                 </div>
             </section>
        </div>
    </aside>

    <div class="pop-up-container" id="popUpContainer">
        <div class="new-playlist" id="popUpPlaylist">
            <header>
                <h2>Nouvelle playlist <img src="/assets/icons/shape_1.svg"/></h2>
                <button id="btnClosePopUp" type="button">
                    <img src="/assets/icons/close.svg" alt="close"/>
                </button>
            </header>
            <form>

                <div class="top-content">
                    <div class="container-cover">
                        <img src="/assets/images/cover_so_la_lune.png" alt="cover"/>
                    </div>
                    <div class="text-field">
                        <img src="/Assets/icons/pencil.svg" alt="user"/>
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
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
                                </div>
                            </div>
                            <div class="artiste-row glass suggestion">
                                <div class="infos">
                                    <div class="container-cover">
                                        <img src="/assets/images/cover_so_la_lune.png" alt="cover">
                                    </div>
                                    <div class="texts">
                                        <h4>L'enfant de la pluie</h4>
                                        <h5>So la lune</h5>
                                    </div>
                                </div>
                                <div class="actions">
                                    <img src="/assets/icons/add-circle.svg"/>
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