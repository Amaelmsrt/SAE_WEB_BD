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
                    if (hasArtist(data)) {
                        miseEnPlaceArtiste(hasArtist(data), data);
                    } else if (hasAlbum(data)) {
                        miseEnPlaceAlbum(hasAlbum(data), data);
                    } else if (hasTrack(data)) {
                        miseEnPlaceTitre(data);
                    }
                    else{
                        noresult();
                    }
                }
            });
        }
        else{
            noresult();
        }
    });
});



// Fonction qui retourne si il y a un artiste dans la recherche
function hasArtist(data) {
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'artiste') {
            return data[i];
        }
    }
    return false;
}

// Fonction qui retourne si il y a un album dans la recherche
function hasAlbum(data) {
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'album') {
            return data[i];
        }
    }
    return false;
}

// Fonction qui retourne si il y a un titre dans la recherche
function hasTrack(data) {
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'son') {
            return data[i];
        }
    }
    return false;
}

function miseEnPlaceArtiste(artiste, data){
    const idArtiste = artiste.id;
    console.log(data);
    const otherArtiste = getOtherArtiste(data, idArtiste);
    const otherAlbum = getAlbum(data);
    fetch ('/controlleurApi.php/artiste/' + idArtiste, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        // Gauche
        const cover = document.getElementById('cover-best-recherche');
        cover.classList.remove('no-result');
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const type = document.getElementById('type-best-recherche');
        type.classList.remove('no-result');
        type.innerHTML = 'Artiste';
        const name = document.getElementById('nom-best-recherche');
        name.classList.remove('no-result');
        name.innerHTML = data.nom;
        const img = document.getElementById('img-best-recherche');
        img.classList.remove('no-result');

        // Droite
        for (let i = 0; i < data.topSon.length; i++) {
            const cover = document.getElementById('cover-best-recherche-2-' + (i + 1));
            cover.classList.remove('no-result');
            cover.setAttribute('src', "data:image/png;base64," + data.topSon[i].cover);
            const type = document.getElementById('type-best-recherche-2-' + (i + 1));
            type.classList.remove('no-result');
            type.innerHTML = data.nom;
            const name = document.getElementById('nom-best-recherche-2-' + (i + 1));
            name.classList.remove('no-result');
            name.innerHTML = data.topSon[i].titre;
            const img = document.getElementById('img-best-recherche-2-' + (i + 1));
            img.classList.remove('no-result');
        }
    })
    if (otherAlbum.length > 0) {
        console.log(otherAlbum);
        const albumContent = document.getElementById('contentOtherAlbums');
        albumContent.innerHTML = '';
    }
    for (let i = 0; i < otherArtiste.length; i++) {
        fetch ('/controlleurApi.php/artiste/' + otherArtiste[i].id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            const album = data;
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
                        <h5>${album.nom}</h5>
                    </div>
                </div>
            `;
            albumContent.appendChild(div);
        })
    }
}


function miseEnPlaceAlbum(album, data){
    const idAlbum = album.id;
    const otherAlbum = getOtherAlbum(data, idAlbum);
    fetch ('/controlleurApi.php/album/' + idAlbum, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        // Gauche
        const cover = document.getElementById('cover-best-recherche');
        cover.classList.remove('no-result');
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const type = document.getElementById('type-best-recherche');
        type.classList.remove('no-result');
        type.innerHTML = 'Album';
        const name = document.getElementById('nom-best-recherche');
        name.classList.remove('no-result');
        name.innerHTML = data.titre;
        const img = document.getElementById('img-best-recherche');
        img.classList.remove('no-result');

        // Droite
        for (let i = 0; i < data.topSon.length; i++) {
            const cover = document.getElementById('cover-best-recherche-2-' + (i + 1));
            cover.classList.remove('no-result');
            cover.setAttribute('src', "data:image/png;base64," + data.topSon[i].cover);
            const type = document.getElementById('type-best-recherche-2-' + (i + 1));
            type.classList.remove('no-result');
            type.innerHTML = data.nom;
            const name = document.getElementById('nom-best-recherche-2-' + (i + 1));
            name.classList.remove('no-result');
            name.innerHTML = data.topSon[i].titre;
            const img = document.getElementById('img-best-recherche-2-' + (i + 1));
            img.classList.remove('no-result');
        }
    })
    // if (otherAlbum.length > 0){
    //     const albumContent = document.getElementById('contentOtherAlbums');
    //     albumContent.innerHTML = '';
    // }
    for (let i = 0; i < otherAlbum.length; i++) {
        fetch ('/controlleurApi.php/album/' + otherAlbum[i].id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            const albumContent = document.getElementById('contentOtherAlbums');
            const album = data;
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
                        <h5>${album.artiste}</h5>
                    </div>
                </div>
            `;
            albumContent.appendChild(div);
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
        })
    }
}

function miseEnPlaceTitre(data){
    
    const idTitres = [];
    for (let i = 0; i < data.length; i++) {
        idTitres.push(data[i].id);
    }
    fetch ('/controlleurApi.php/son/' + idTitres[0], {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        // Gauche
        const cover = document.getElementById('cover-best-recherche');
        cover.classList.remove('no-result');
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const type = document.getElementById('type-best-recherche');
        type.classList.remove('no-result');
        type.innerHTML = data.artiste;
        const name = document.getElementById('nom-best-recherche');
        name.classList.remove('no-result');
        name.innerHTML = data.titre;
        const img = document.getElementById('img-best-recherche');
        img.classList.add('no-result');

        // Droite
        // Je souhaite affiché les autres son mais au maximum 3, il est possible que le nombre de son soit inférieur à 3 donc je dois gérer ce cas
        for (let i = 1; i <= 3; i++) {
            if (idTitres[i]) {
                fetch ('/controlleurApi.php/son/' + idTitres[i], {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    const cover = document.getElementById('cover-best-recherche-2-' + i);
                    cover.setAttribute('src', "data:image/png;base64," + data.cover);
                    cover.classList.remove('no-result');
                    const type = document.getElementById('type-best-recherche-2-' + i);
                    type.innerHTML = data.artiste;
                    type.classList.remove('no-result');
                    const name = document.getElementById('nom-best-recherche-2-' + i);
                    name.innerHTML = data.titre;
                    name.classList.remove('no-result');
                    const img = document.getElementById('img-best-recherche-2-' + i);
                    img.classList.remove('no-result');
                })
            } else {
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
    })
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

function getOtherArtiste(data, idArtiste){
    const otherArtiste = [];
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'artiste' && data[i].id !== idArtiste) {
            otherArtiste.push(data[i]);
        }
    }
    return otherArtiste;
}

function getAlbum(data){
    const album = [];
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'album') {
            album.push(data[i]);
        }
    }
    return album;
}

function getOtherAlbum(data, idAlbum){
    const otherAlbum = [];
    for (let i = 0; i < data.length; i++) {
        if (data[i].type === 'album' && data[i].id !== idAlbum) {
            otherAlbum.push(data[i]);
        }
    }
    return otherAlbum;
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


// <?php foreach ($artisteAlea as $artist) : 
// $isLike = $likeArtisteDB->isLiked($artist->getId(), $_SESSION["user_id"]);
// ?>

// <!-- <div class="song-card artiste">
//     <div class="background" aria-hidden></div>
//     <div class="container-image">
//         <img class="cover" src="data:image/jpeg;base64, <?= $artist->getPicture() ?>" alt="cover"/>
//     </div>
//     <div class="bottom-content">
//         <div class="texts">
//             <h4><?= $artist->getName() ?></h4>
//             <h5>Artiste</h5>
//         </div>
//         <?php if ($isLike) : ?>
//             <svg class="svg-heart like likeArtist" data-id-artiste="<?= $artist->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
//             </svg>
//         <?php else : ?>
//             <svg class="svg-heart likeArtist" data-id-artiste="<?= $artist->getId() ?>" data-id="<?= $_SESSION["user_id"] ?>" width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="currentColor" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
//             </svg>
//         <?php endif; ?>
//     </div>
// </div>
// <?php endforeach; ?> -->