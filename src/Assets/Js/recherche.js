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
        }
        else if (principal.type === 'Album') {
            img.setAttribute('src', '/Assets/icons/expand.svg');
            div.addEventListener('click', showArtiste);
            div.removeEventListener('click', function () {handleJouerSon(this);});
        }
        else{
            div.setAttribute('data-id-song', principal.id);
            div.addEventListener('click', function () {handleJouerSon(this);});
            div.removeEventListener('click', showArtiste);
            img.setAttribute('src', "./assets/icons/play.svg");
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


// <!-- <?php if ($isLike) : ?>
// <svg class="svg-heart like likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
// <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
// </svg>
// <?php else : ?>
// <svg class="svg-heart likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
// <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
// </svg>
// <?php endif; ?> -->
