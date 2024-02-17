afficheMesFavoris();

const btnPlaylist = document.querySelectorAll('.btnPlaylist');
btnPlaylist.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        afficheMaPlaylist();
        const idPlaylist = btn.getAttribute('id-playlist');
        handleMajPlaylist(idPlaylist);
    });
});


const btnsAddPlaylist = document.querySelectorAll('.actions-add');
btnsAddPlaylist.forEach(btn => {
    btn.addEventListener('click', () => {
        const idSong = btn.getAttribute('id-song');
        handleAdd(idSong);
    });
});

let playlist = [];

function handleAdd(idSong) {
    const div = document.getElementById(`action-${idSong}`);
    if (playlist.includes(idSong)) {
        playlist = playlist.filter(id => id !== idSong);
        div.querySelector('img').src = './Assets/icons/add-circle.svg';
    } else {
        playlist.push(idSong);
        div.querySelector('img').src = './Assets/icons/check-circle.svg';
    }
}

const newP = document.getElementById('newP');
newP.addEventListener('click', () => {
    const titrePlaylist = document.getElementById('titrePlaylistInput');
    const titrePlaylistV = titrePlaylist.value;
    titrePlaylist.value = '';
    const titrePlaylistUTF8 = encodeURIComponent(titrePlaylistV);
    btnsAddPlaylist.forEach(element => {
        element.querySelector('img').src = './Assets/icons/add-circle.svg';
    });
    closePlaylistPopUp();

    pathSong = playlist.join(',');
    fetch('/controlleurApi.php/newPlaylist/' + titrePlaylistUTF8 + "/" + pathSong, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })

    .then(res => res.json())
    .then(data => {
        addNewPlaylist(data);
    })
    .catch(err => console.log(err));
});

function addNewPlaylist(data) {
    id = data.id;
    titre = data.titre;
    artistes = data.artiste;
    const contentPlaylist = document.getElementById('contentPlaylists');
    const div1 = document.createElement('div');
    div1.classList.add('artiste-wrapper');
    const div2 = document.createElement('div');
    div2.classList.add('btnPlaylist', 'artiste-row', 'playlist', 'glass', 'with-dots');
    div2.innerHTML = `
        <div class="infos">
            <div class="container-cover">
                <img src="./Assets/images/cover_so_la_lune.png" alt="cover">
            </div>
            <div class="texts">
                <h4>${titre}</h4>
                <h5>${artistes}</h5>
            </div>
        </div>
        <div class="actions">
            <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
        </div>
    `;
    div1.appendChild(div2);
    contentPlaylist.appendChild(div1);
    div2.addEventListener('click', () => {
        handleMajPlaylist(id);
        afficheMaPlaylist(id);
    });
}

function handleMajPlaylist(id) {
    const titrePlaylist = document.getElementById('titrePlaylist');
    const dureePlaylist = document.getElementById('dureePlaylist');
    const buttonPlayPlaylist = document.getElementById('buttonPlayPlaylist');

    fetch('/controlleurApi.php/getPlaylist/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        titrePlaylist.innerHTML = data.titre;
        dureePlaylist.innerHTML = "Durée : " + data.duree;
        buttonPlayPlaylist.setAttribute('id-playlist', id);
        const songs = data.sons;
        const contentPlaylist = document.getElementById('contentPlaylistSongs');
        contentPlaylist.innerHTML = '';

        songs.forEach(song => {
            const div1 = document.createElement('div');
            div1.classList.add('artiste-wrapper');
            const div = document.createElement('div');
            div.classList.add('artiste-row', 'glass', 'with-dots');
            div.setAttribute('data-id-song', song.id);
            div1.appendChild(div);
            div.innerHTML = `
                <div class="infos">
                    <div class="container-cover">
                        <img src="data:image/png;base64,${song.cover}" alt="cover">
                    </div>
                    <div class="texts">
                        <h4>${song.titre}</h4>
                        <h5>${song.artist}</h5>
                    </div>
                </div>
                <div class="actions">
                    <img class="menu-dots" src="./Assets/icons/menu-dots.svg" alt="open menu"/>
                </div>
            `;
            div1.innerHTML += `
                <div class="menu">
                    <ul>
                        <li>
                        <button class="consulteArtiste-fav" id-artiste="${song.idArtist}">
                                <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                        
                                Consulter l'artiste
                            </button>
                        </li>
                        <li>
                            <button class="consuleAlbum-fav" id-album="${song.album}">
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>    
                                Consulter l'album
                            </button>
                        </li>
                        <li>
                            <button class="fileAttente-fav" data-id="${song.id}">
                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4H9M13 4H19M16 7V1M4 9H13M8 14H10" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                        
                                Ajouter à la file d'attente
                            </button>
                        </li>
                        <li class="has-sub-menu">
                            <div class="cursor-container"></div>
                            <button class="addToPlaylist">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="#FEFCE1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                        
                                Ajouter à la playlist
                                <svg class="chevron" width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 13L7 7L1 1" stroke="#FEFCE1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <div class="sub">
                                <div class="cursor-container right"></div>
                                <ul>
                                    <li class="new-playlist">
                                        <button>
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.271 12.1915V16.1915M16.271 14.1915H12.271M13.271 7.19153H15.271C16.3756 7.19153 17.271 6.2961 17.271 5.19153V3.19153C17.271 2.08696 16.3756 1.19153 15.271 1.19153H13.271C12.1664 1.19153 11.271 2.08696 11.271 3.19153V5.19153C11.271 6.2961 12.1664 7.19153 13.271 7.19153ZM3.271 17.1915H5.271C6.37557 17.1915 7.271 16.2961 7.271 15.1915V13.1915C7.271 12.087 6.37557 11.1915 5.271 11.1915H3.271C2.16643 11.1915 1.271 12.087 1.271 13.1915V15.1915C1.271 16.2961 2.16643 17.1915 3.271 17.1915ZM3.271 7.19153H5.271C6.37557 7.19153 7.271 6.2961 7.271 5.19153V3.19153C7.271 2.08696 6.37557 1.19153 5.271 1.19153H3.271C2.16643 1.19153 1.271 2.08696 1.271 3.19153V5.19153C1.271 6.2961 2.16643 7.19153 3.271 7.19153Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg> 
                                            Nouvelle playlist  
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 1
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 2
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 3
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 4
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 5
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 1
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 2
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 3
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 4
                                        </button>
                                    </li>
                                    <li>
                                        <button>
                                            playlist 5
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button data-id="${data.idUser}" class="likeSong-fav" data-id-song="${song.id}">
                                <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                                        
                                Liker ce titre
                            </button>
                        </li>
                    </ul>
                </div>
            `;
            contentPlaylist.appendChild(div1);
            const menuDots = div1.querySelector('.menu-dots');
            menuDots.addEventListener('click', function (e) {
                handleMenuDotsClick(e);
            });

            // Ajout des events sur les boutons du menu
            const btnConsultAlbum = div1.querySelector('.consuleAlbum-fav');
            btnConsultAlbum.addEventListener('click', function (e) {
                console.log('click');
                e.stopPropagation();
                const idAlbum = btnConsultAlbum.getAttribute('id-album');
                console.log(idAlbum);
                changeCurrentMenu(e, 1);
                majAlbum(idAlbum);
                showArtiste();
            });

            const btnConsultArtiste = div1.querySelector('.consulteArtiste-fav');
            btnConsultArtiste.addEventListener('click', function (e) {
                e.stopPropagation();
                const idArtiste = btnConsultArtiste.getAttribute('id-artiste');
                console.log(idArtiste);
                changeCurrentMenu(e, 1);
                majArtiste(idArtiste);
                showArtiste();
            });

            const btnFileAttente = div1.querySelector('.fileAttente-fav');
            btnFileAttente.addEventListener('click', function (e) {
                e.stopPropagation();
                const idSon = btnFileAttente.getAttribute('data-id');
                listeDattenteObj.addSon(idSon);
                handleFileDattente(1);
            });

            const btnLikeSon = div1.querySelector('.likeSong-fav');
            btnLikeSon.addEventListener('click', function (e) {
                e.stopPropagation();
                handleLike(this);
            });



            div1.addEventListener('click', function () {handleJouerSon(this);});
            div1.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div1.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
        });
    })
}

const buttonPlayPlaylist = document.getElementById('buttonPlayPlaylist');
buttonPlayPlaylist.addEventListener('click', () => {
    const idPlaylist = buttonPlayPlaylist.getAttribute('id-playlist');
    handleJouerPlaylist(idPlaylist);
});


// Recherche une playlist

const inputSearchPlaylist = document.getElementById('inputSearchPlaylist');
inputSearchPlaylist.addEventListener('keyup', (e) => {
    const search = e.target.value;
    const playlists = document.querySelectorAll('.btnPlaylist');
    playlists.forEach(playlist => {
        const titre = playlist.querySelector('h4').innerText;
        if (titre.toLowerCase().includes(search.toLowerCase())) {
            playlist.style.display = 'flex';
        } else {
            playlist.style.display = 'none';
        }
    });
});


// Evenet sur les boutons du menu favoris

const btnConsultsArtistes = document.querySelectorAll('.consulteArtiste-fav');
btnConsultsArtistes.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const idArtiste = btn.getAttribute('id-artiste');
        changeCurrentMenu(e, 1);
        majArtiste(idArtiste);
        showArtiste();
    });
});

const btnConsultsAlbums = document.querySelectorAll('.consuleAlbum-fav');
btnConsultsAlbums.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const idAlbum = btn.getAttribute('id-album');
        changeCurrentMenu(e, 1);
        majAlbum(idAlbum);
        showArtiste();
    });
});

const btnAddQueue = document.querySelectorAll('.fileAttente-fav');
btnAddQueue.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        handleAjouterSonFile(btn);
    });
});

const btnFav = document.querySelectorAll('.likeSong-fav');
btnFav.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        handleLike(btn);
    });
});