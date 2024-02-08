// Ajout event sur les boutons du menu d'un son
for (let i = 1; i <= 3; i++) {
    const buttonAddFile = document.getElementById('fileAttente-' + (i));
    const like = document.getElementById('like-' + (i));
    buttonAddFile.addEventListener('click', function (e) {
        e.stopPropagation();
        handleAjouterSonFile(this);
    });
    like.addEventListener('click', function (e) {
        e.stopPropagation();
        handleLike(this);
    });
}

const div = document.getElementById('bestResult');
div.removeEventListener('click', showArtiste);
div.addEventListener('click', function (e) {
    console.log(this);
    if (this.getAttribute('v') === 'v'){
        console.log('v');
    }
    else{
        this.setAttribute('data-id-song', '');
    }
    const type = this.getAttribute('data-type');
    if (type === 'Artiste') {
        console.log('artiste');
        majArtiste(this.getAttribute('data-id'));
    }
    else if (type === 'Album') {
        console.log('album');
        majAlbum(this.getAttribute('data-id'));
    }
    else{
        console.log('son');
        e.stopPropagation();
        this.removeAttribute('v');
        this.removeEventListener('click', showArtiste);
    }
});




document.addEventListener('DOMContentLoaded', function () {

    const search = document.getElementById('search');

    search.addEventListener('keyup', function () {
        const searchValue = search.value.trim(); // Utilisez trim() pour supprimer les espaces au début et à la fin
        const searchValueSansEspace = searchValue.replace(/\s/g, '_'); // Remplace les espaces par '_'
        const encodedSearchValue = encodeURIComponent(searchValueSansEspace); // Encode les caractères spéciaux, y compris les accents

        if (searchValue !== '') {
            fetch('/controlleurApi.php/recherche/' + encodedSearchValue, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    // todo: afficher un message d'erreur
                } else {
                    miseEnPlaceInfos(data);
                }
            });
        }
        else{
            noresult();
        }
    });
});


function miseEnPlaceInfos(data){
    const principal = data.principal;
    const albums = data.albums;
    const artistes = data.artistes;

    if (principal.id) {
        // Gauche

        const div = document.getElementById('bestResult');
        const cover = document.getElementById('cover-best-recherche');
        cover.classList.remove('no-result');
        cover.setAttribute('src', "data:image/png;base64," + principal.cover);
        const type = document.getElementById('type-best-recherche');
        type.classList.remove('no-result');
        type.innerHTML = principal.type;
        const name = document.getElementById('nom-best-recherche');
        name.classList.remove('no-result');
        name.innerHTML = principal.nom;
        const img = document.getElementById('img-best-recherche');
        img.classList.remove('no-result');
        if (principal.type === 'Artiste') {
            img.setAttribute('src', '/Assets/icons/expand.svg');
            div.addEventListener('click', showArtiste);
            div.removeEventListener('click', function () {handleJouerSon(this);});
            div.setAttribute('data-id', principal.id);
            div.setAttribute('data-type', principal.type);
        }
        else if (principal.type === 'Album') {
            img.setAttribute('src', '/Assets/icons/expand.svg');
            div.addEventListener('click', showArtiste);
            div.removeEventListener('click', function () {handleJouerSon(this);});
            div.removeEventListener('click', majArtiste);
            div.setAttribute('data-id', principal.id);
            div.setAttribute('data-type', principal.type);
        }
        else{
            div.setAttribute('v', 'v');
            div.setAttribute('data-type', principal.type);
            div.setAttribute('data-id-song', principal.id);
            div.addEventListener('click', function (e) {
                e.stopPropagation();
                handleJouerSon(this);
            });
            div.removeEventListener('click', showArtiste);
            img.setAttribute('src', "./assets/icons/play.svg");
            div.removeEventListener('click', majArtiste);
        }

        // Droite
        for (let i = 0; i < 3; i++) {
            if (principal.topSon[i]){
                const div = document.getElementById('otherResults-' + (i + 1));
                div.setAttribute('data-id-song', principal.topSon[i].id);
                div.addEventListener('click', function () {handleJouerSon(this);});
                const cover = document.getElementById('cover-best-recherche-2-' + (i + 1));
                cover.classList.remove('no-result');
                cover.setAttribute('src', "data:image/png;base64," + principal.topSon[i].cover);
                const type = document.getElementById('type-best-recherche-2-' + (i + 1));
                type.classList.remove('no-result');
                if (principal.topSon[i].artiste){
                    type.innerHTML = principal.topSon[i].artiste;
                }
                else{
                    type.innerHTML = principal.nom;
                }
                const name = document.getElementById('nom-best-recherche-2-' + (i + 1));
                name.classList.remove('no-result');
                name.innerHTML = principal.topSon[i].titre;
                const img = document.getElementById('img-best-recherche-2-' + (i + 1));
                img.classList.remove('no-result');

                // Button du menu
                const buttonAddFile = document.getElementById('fileAttente-' + (i + 1));
                buttonAddFile.setAttribute('data-id', principal.topSon[i].id);
                const buttonAddFav = document.getElementById('like-' + (i + 1));
                buttonAddFav.setAttribute('data-id-song', principal.topSon[i].id);
            }
            else{
                const div = document.getElementById('otherResults-' + (i + 1));
                div.setAttribute('data-id-song', '');
                div.removeEventListener('click', function () {handleJouerSon(this);});
                const cover = document.getElementById('cover-best-recherche-2-' + (i + 1));
                cover.setAttribute('src', '');
                const type = document.getElementById('type-best-recherche-2-' + (i + 1));
                type.innerHTML = '';
                const name = document.getElementById('nom-best-recherche-2-' + (i + 1));
                name.innerHTML = '';
                cover.classList.add('no-result');
                type.classList.add('no-result');
                name.classList.add('no-result');
                const img = document.getElementById('img-best-recherche-2-' + (i + 1));
                img.classList.add('no-result');
            }
        }
    }
    else{
        noresult();
    }
    if (albums.length > 0) {
        const albumContent = document.getElementById('contentOtherAlbums');
        albumContent.innerHTML = '';
        for (let i = 0; i < albums.length; i++) {
            const album = albums[i];
            const div = document.createElement('div');
            div.classList.add('song-card');
            div.classList.add('playAlbum');
            div.setAttribute('data-id-album', album.id);
            div.innerHTML = `
                <div class="background" aria-hidden="true"></div>
                <div class="container-image">
                    <img class="cover" src="data:image/png;base64, ${album.cover}" alt="cover"/>
                    <img src="/Assets/icons/play.svg" alt="play" class="play"/>
                </div>
                <div class="bottom-content">
                    <div class="texts">
                        <h4>${album.nom}</h4>
                        <h5>${album.artiste}</h5>
                    </div>
                </div>
            `;
            albumContent.appendChild(div);
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
            div.addEventListener('click', function () {handleJouerAlbum(this);});
        }
    }
    else{
        const albumContent = document.getElementById('contentOtherAlbums');
        albumContent.innerHTML = '';
    }
    
    if (artistes.length > 0) {
        const artisteContent = document.getElementById('contentOtherArtiste');
        artisteContent.innerHTML = '';
        for (let i = 0; i < artistes.length; i++) {
            const artiste = artistes[i];
            const div = document.createElement('div');
            div.classList.add('song-card');
            div.classList.add('playAlbum');
            div.setAttribute('data-id-artiste', artiste.id);
            div.innerHTML = `
                <div class="background" aria-hidden="true"></div>
                <div class="container-image">
                    <img class="cover" src="data:image/png;base64, ${artiste.cover}" alt="cover"/>
                    <img src="/Assets/icons/play.svg" alt="play" class="play"/>
                </div>
                <div class="bottom-content">
                    <div class="texts">
                        <h4>${artiste.nom}</h4>
                        <h5>Artiste</h5>
                    </div>
                </div>
            `;
            artisteContent.appendChild(div);
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
            div.addEventListener('click', function () {handleJouerSonArtiste(this);});
        }
    }
    else{
        const artisteContent = document.getElementById('contentOtherArtiste');
        artisteContent.innerHTML = '';
    }
}


function noresult(){
    const cover = document.getElementById('cover-best-recherche');
    cover.classList.add('no-result');
    const type = document.getElementById('type-best-recherche');
    type.classList.add('no-result');
    const name = document.getElementById('nom-best-recherche');
    name.classList.add('no-result');
    const img = document.getElementById('img-best-recherche');
    img.classList.add('no-result');
    const div = document.getElementById('bestResult');
    div.setAttribute('data-id', '');
    div.setAttribute('data-type', '');
    div.removeEventListener('click', showArtiste);
    div.removeEventListener('click', function () {handleJouerSon(this);});
    div.removeEventListener('click', majArtiste);
    div.removeAttribute('v');

    for (let i = 1; i <= 3; i++) {
        const div = document.getElementById('otherResults-' + (i));
        div.setAttribute('data-id-song', '');
        const cover = document.getElementById('cover-best-recherche-2-' + i);
        cover.setAttribute('src', '');
        const type = document.getElementById('type-best-recherche-2-' + i);
        type.innerHTML = '';
        const name = document.getElementById('nom-best-recherche-2-' + i);
        name.innerHTML = '';
        cover.classList.add('no-result');
        type.classList.add('no-result');
        name.classList.add('no-result');
        const img = document.getElementById('img-best-recherche-2-' + i);
        img.classList.add('no-result');
    }
}

function majAlbum(id){
    fetch('/controlleurApi.php/albumInfo/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        const nav = document.getElementById('navArtiste');
        nav.style.display = 'none';
        const cover = document.getElementById('coverArtisteDetail');
        const name = document.getElementById('nomArtisteDetail');
        const artiste = document.getElementById('nbAlbumsArtiste');
        artiste.innerHTML = data.artiste;

        name.innerHTML = data.titre;
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const nbLikes = document.getElementById('nbLikesA');
        nbLikes.innerHTML = `
        <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        `
        if (data.nbLikes < 2){
            nbLikes.innerHTML += data.nbLikes + ' titre liké';
        }
        else{
            nbLikes.innerHTML += data.nbLikes + ' titres likés';
        }
        const playArtist = document.getElementById('playArtiste');
        playArtist.setAttribute('data-id-album', data.id);
        playArtist.removeAttribute('data-id-artiste');
        document.getElementById('TopTitres').innerHTML = '';
        for (let i = 0; i < data.sons.length; i++) {
            const div = document.createElement('div');
            div.classList.add('artiste-wrapper');
            div.attributes['id'] = 'div-top-titres-' + (i + 1);
            div.setAttribute('data-id-song', data.sons[i].id);
            div.innerHTML = `
                <div class="artiste-row glass with-dots">
                    <div class="infos">
                        <div class="container-cover">
                            <img id="top-titres-cover-${i + 1}" src="data:image/png;base64, ${data.sons[i].cover}" alt="cover"/>
                        </div>
                        <div class="texts">
                            <h4 id="top-titres-album-${i + 1}">${data.sons[i].titre}</h4>
                            <h5 id="top-titres-artiste-${i + 1}">${data.artiste}</h5>
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
                            <button class="addToQueue">
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
                            <button class="like">
                                <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Liker ce titre
                            </button>
                        </li>
                    </ul>
                </div>
            `;
            div.querySelector('.menu-dots').addEventListener('click', handleMenuDotsClick)
            div.addEventListener('click', function () {handleJouerSon(this);});
            div.querySelector('.addToQueue').addEventListener('click', function (e) {
                this.setAttribute('data-id', data.sons[i].id);
                e.stopPropagation();
                handleAjouterSonFile(this);
            });
            const idUser = document.getElementById('TopTitres').getAttribute('id-user');
            div.querySelector('.like').addEventListener('click', function (e) {
                this.setAttribute('data-id-song', data.sons[i].id);
                this.setAttribute('data-id', document.getElementById('TopTitres').getAttribute('id-user'));
                e.stopPropagation();
                handleLike(this);
            });
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
            document.getElementById('TopTitres').appendChild(div);
        }
    });
}

const playArtist = document.getElementById('playArtiste');
playArtist.addEventListener('click', function () {
    if (this.getAttribute('data-id-album')){
        handleJouerAlbum(this);
    }
    else{
        handleJouerSonArtiste(this);
    }
});

function majArtiste(id){
    fetch('/controlleurApi.php/artistInfo/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        const nav = document.getElementById('navArtiste');
        nav.style.display = 'flex';
        const cover = document.getElementById('coverArtisteDetail');
        const name = document.getElementById('nomArtisteDetail');
        const artiste = document.getElementById('nbAlbumsArtiste');
        artiste.innerHTML = '';
        name.innerHTML = data.nom;
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const nbLikes = document.getElementById('nbLikesA');
        nbLikes.innerHTML = `
        <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        `
        if (data.nbLikes < 2){
            nbLikes.innerHTML += data.nbLikes + ' titre liké';
        }
        else{
            nbLikes.innerHTML += data.nbLikes + ' titres likés';
        }
        const playArtist = document.getElementById('playArtiste');
        playArtist.setAttribute('data-id-artiste', data.id);
        document.getElementById('TopTitres').innerHTML = '';
        playArtist.removeAttribute('data-id-album');
        for (let i = 0; i < 5; i++) {
            if (data.topSon[i]){
                const div = document.createElement('div');
                div.classList.add('artiste-wrapper');
                div.attributes['id'] = 'div-top-titres-' + (i + 1);
                div.setAttribute('data-id-song', data.topSon[i].id);
                div.innerHTML = `
                <div class="artiste-row glass with-dots">
                    <div class="infos">
                        <div class="container-cover">
                            <img id="top-titres-cover-${i + 1}" src="data:image/png;base64, ${data.topSon[i].cover}" alt="cover"/>
                        </div>
                        <div class="texts">
                            <h4 id="top-titres-album-${i + 1}">${data.topSon[i].titre}</h4>
                            <h5 id="top-titres-artiste-${i + 1}">${data.nom}</h5>
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
                            <button class="addToQueue">
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
                            <button class="like">
                                <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Liker ce titre
                            </button>
                        </li>
                    </ul>
                </div>
            `;
                div.querySelector('.menu-dots').addEventListener('click', handleMenuDotsClick)
                div.addEventListener('click', function () {handleJouerSon(this);});
                div.querySelector('.addToQueue').addEventListener('click', function (e) {
                    this.setAttribute('data-id', data.topSon[i].id);
                    e.stopPropagation();
                    handleAjouterSonFile(this);
                });
                div.querySelector('.like').addEventListener('click', function (e) {
                    this.setAttribute('data-id-song', data.topSon[i].id);
                    this.setAttribute('data-id', document.getElementById('TopTitres').getAttribute('id-user'));
                    e.stopPropagation();
                    handleLike(this);
                });
                div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
                div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
                document.getElementById('TopTitres').appendChild(div);
            }
        }
        const albumContent = document.getElementById('Albums');
        albumContent.innerHTML = '';
        for (let i = 0; i < data.albums.length; i++) {
            const album = data.albums[i];
            const div = document.createElement('div');
            div.classList.add('song-card');
            div.classList.add('playAlbum');
            div.setAttribute('data-id-album', album.id);
            div.innerHTML = `
                <div class="background" aria-hidden="true"></div>
                <div class="container-image">
                    <img class="cover" src="data:image/png;base64, ${album.cover}" alt="cover"/>
                    <img src="/Assets/icons/play.svg" alt="play" class="play"/>
                </div>
                <div class="bottom-content">
                    <div class="texts">
                        <h4>${album.titre}</h4>
                        <h5>${data.nom}</h5>
                    </div>
                </div>
            `;
            albumContent.appendChild(div);
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
            div.addEventListener('click', function () {handleJouerAlbum(this);});
        }
    });
}

// const div = document.getElementById('div-top-titres-' + (i + 1));
// div.setAttribute('data-id-song', data.topSon[i].id);
// div.addEventListener('click', function () {handleJouerSon(this);});

// const cover = document.getElementById('top-titres-cover-' + (i + 1));
// cover.setAttribute('src', "data:image/png;base64," + data.topSon[i].cover);
// const album = document.getElementById('top-titres-album-' + (i + 1));
// album.innerHTML = data.topSon[i].titre;
// const artiste = document.getElementById('top-titres-artiste-' + (i + 1));
// artiste.innerHTML = data.nom;

// // Button du menu
// const buttonAddFile = document.getElementById('addToQueue-' + (i + 1));
// buttonAddFile.setAttribute('data-id', data.topSon[i].id);
// const buttonAddFav = document.getElementById('like-' + (i + 1) + '-1');
// buttonAddFav.setAttribute('data-id-song', data.topSon[i].id);



// <!-- <?php if ($isLike) : ?>
// <svg class="svg-heart like likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
// <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
// </svg>
// <?php else : ?>
// <svg class="svg-heart likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
// <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
// </svg>
// <?php endif; ?> -->
