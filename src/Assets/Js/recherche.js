document.addEventListener('DOMContentLoaded', function () {

    const search = document.getElementById('search');

    search.addEventListener('keyup', function () {
        const searchValue = search.value.toLowerCase();
        const searchValueSansEspace = searchValue.replace(/\s/g, '_'); // remplace les espaces par '_'

        if (searchValue != '') {
            fetch('/controlleurApi.php/recherche/' + searchValueSansEspace, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    // todo: afficher un message d'erreur
                }
                else {
                    if (hasArtist(data)) {
                        miseEnPlaceArtiste(hasArtist(data));
                    }
                    else if (hasAlbum(data)) {
                        console.log(hasAlbum(data));
                    }
                    else if (hasTrack(data)) {
                        console.log(hasTrack(data));
                    }
                }
            });
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

function miseEnPlaceArtiste(artiste){
    const idArtiste = artiste.id;
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
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        const type = document.getElementById('type-best-recherche');
        type.innerHTML = 'Artiste';
        const name = document.getElementById('nom-best-recherche');
        name.innerHTML = data.nom;

        // Droite
        for (let i = 0; i < data.topSon.length; i++) {
            const cover = document.getElementById('cover-best-recherche-2-' + (i + 1));
            cover.setAttribute('src', "data:image/png;base64," + data.topSon[i].cover);
            const type = document.getElementById('type-best-recherche-2-' + (i + 1));
            type.innerHTML = data.nom;
            const name = document.getElementById('nom-best-recherche-2-' + (i + 1));
            name.innerHTML = data.topSon[i].titre;
        }
    })
}


function miseEnPlaceAlbum(album){
    const idAlbum = album.id;
    fetch ('/controlleurApi.php/album/' + idAlbum, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
}
