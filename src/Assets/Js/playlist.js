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
            const div = document.createElement('div');
            div.classList.add('artiste-row', 'glass', 'with-dots');
            div.setAttribute('data-id-song', song.id);
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
            contentPlaylist.appendChild(div);
            div.addEventListener('click', function () {handleJouerSon(this);});
            div.addEventListener('mouseenter', (e)=> handleSongCardHover(e, false))
            div.addEventListener('mouseleave', (e) => handleSongCardHover(e,true))
        });
    })
}

const buttonPlayPlaylist = document.getElementById('buttonPlayPlaylist');
buttonPlayPlaylist.addEventListener('click', () => {
    const idPlaylist = buttonPlayPlaylist.getAttribute('id-playlist');
    handleJouerPlaylist(idPlaylist);
});