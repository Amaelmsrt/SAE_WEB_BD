var listeDattenteObj = ListeDattente.getInstance() ;

if (listeDattenteObj.numSonEnCours) {
    recupSon(listeDattenteObj.numSonEnCours);
}


const btnLikeArtiste = document.querySelectorAll('.likeArtist');

btnLikeArtiste.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        const artisteId = btn.getAttribute('data-id-artiste');
        const idUtilisateur = btn.getAttribute('data-id');

        fetch('/controlleurApi.php/likeArtiste/' + artisteId + '/' + idUtilisateur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.like == true) {
                btn.classList.add('like');
            } else {
                btn.classList.remove('like');
            }
            btnLikeArtiste.forEach(function (btn) {
                if (btn.getAttribute('data-id-artiste') === artisteId) {
                    if (data.like == true) {
                        btn.classList.add('like');
                    } else {
                        btn.classList.remove('like');
                    }
                }
            });
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        });
    });
});


const btnLikeSon = document.querySelectorAll('.likeSong');

btnLikeSon.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        const sonId = btn.getAttribute('data-id-song');
        const idUtilisateur = btn.getAttribute('data-id');

        fetch('/controlleurApi.php/likeSon/' + sonId + '/' + idUtilisateur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.like == true) {
                btn.classList.add('like');
            } else {
                btn.classList.remove('like');
            }
            btnLikeSon.forEach(function (btn) {
                if (btn.getAttribute('data-id-song') === sonId) {
                    if (data.like == true) {
                        btn.classList.add('like');
                    } else {
                        btn.classList.remove('like');
                    }
                }
            });
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        });
    });
});

const btnLikeAlbum = document.querySelectorAll('.likeAlbum');

btnLikeAlbum.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        const albumId = btn.getAttribute('data-id-album');
        const idUtilisateur = btn.getAttribute('data-id');

        fetch('/controlleurApi.php/likeAlbum/' + albumId + '/' + idUtilisateur, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function (data) {
            if (data.like == true) {
                btn.classList.add('like');
            } else {
                btn.classList.remove('like');
            }
            btnLikeAlbum.forEach(function (btn) {
                if (btn.getAttribute('data-id-album') === albumId) {
                    if (data.like == true) {
                        btn.classList.add('like');
                    } else {
                        btn.classList.remove('like');
                    }
                }
            });
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        });
    });
});





// Controleur sur le son en cours de lecture pour lancer le suivant
setInterval(function () {
    if (listeDattenteObj.sonEnCours) {
        if (listeDattenteObj.sonEnCours.ended) {
            if (listeDattenteObj.liste.length > 0) {
                listeDattenteObj.setIndexSonEnCours((listeDattenteObj.indexSonEnCours + 1) % listeDattenteObj.liste.length);
                var idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
                jouerSon(idSon);
            }
        }
    }
}, 1000);


// Lancement d'un album
var boutons = document.querySelectorAll('.playAlbum');
boutons.forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        handleJouerAlbum(this);
    });
});


// Lancement des sons d'un artiste
var boutons = document.querySelectorAll('.playArtist');
boutons.forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        handleJouerSonArtiste(this);
    });
});


// Lancement son top d'un artiste

var boutons = document.querySelectorAll('.topSon');
boutons.forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        var idSon = this.getAttribute('data-id-song');
        listeDattenteObj.setIndexSonEnCours(0);
        listeDattenteObj.setListe([]);
        jouerSon(idSon);
        listeDattenteObj.addSon(idSon);
    });
});


// Met le son courrant en pause
var btnPause = document.getElementById('playPause');
btnPause.addEventListener('click', function () {
    const img = document.getElementById('imgPlayPause');
    if (listeDattenteObj.sonEnCours) {
        if (listeDattenteObj.sonEnCours.paused) {
            listeDattenteObj.sonEnCours.play();
            img.src = "/assets/icons/play-lg.svg";
        } else {
            listeDattenteObj.sonEnCours.pause();
            img.src = "/assets/icons/play.svg";
        }
    }
});

var btnNextR = document.getElementById('next');
btnNextR.addEventListener('click', function () {
    if (listeDattenteObj.liste.length > 0) {
        listeDattenteObj.setIndexSonEnCours((listeDattenteObj.indexSonEnCours + 1) % listeDattenteObj.liste.length);
        var idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
        jouerSon(idSon);

    }
});

var btnNextL = document.getElementById('back');
btnNextL.addEventListener('click', function () {
    if (listeDattenteObj.liste.length > 0) {
        listeDattenteObj.setIndexSonEnCours((listeDattenteObj.indexSonEnCours - 1));
        if (listeDattenteObj.indexSonEnCours < 0) {
            listeDattenteObj.setIndexSonEnCours(listeDattenteObj.indexSonEnCours + listeDattenteObj.liste.length);
        }
        var idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
        jouerSon(idSon);
    }
});

// Jouer un album
function handleJouerAlbum(button){
    var idAlbum = button.getAttribute('data-id-album');
    fetch('/controlleurApi.php/jouerAlbum/' + idAlbum, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    }
    )
    .then(function (lesAudios) {
        // boucle sur les audios
        let cpt = 0;
        listeDattenteObj.setIndexSonEnCours(0);
        if (listeDattenteObj.sonEnCours instanceof Audio) {
            listeDattenteObj.sonEnCours.pause();
            listeDattenteObj.sonEnCours.currentTime = 0;
            listeDattenteObj.setSonEnCours(null, null);
        }
        listeDattenteObj.setSonEnCours(null, null);
        listeDattenteObj.setListe([]);
        lesAudios.forEach(function (audio) {
            if (cpt === 0) {
                jouerSon(audio.id);
                listeDattenteObj.addSon(audio.id);
            }
            else{
                listeDattenteObj.addSon(audio.id);
            }
            cpt = cpt + 1;
        });
    })
}


function handleJouerSonArtiste(button){
    var idArtiste = button.getAttribute('data-id-artiste');
    fetch('/controlleurApi.php/jouerArtiste/' + idArtiste, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(function (lesAudios) {
        // boucle sur les audios
        let cpt = 0;
        listeDattenteObj.setIndexSonEnCours(0);
        listeDattenteObj.setListe([]);
        lesAudios.forEach(function (audio) {
            if (cpt === 0) {
                jouerSon(audio.id);
                listeDattenteObj.addSon(audio.id);
            }
            else{
                listeDattenteObj.addSon(audio.id);
            }
            cpt = cpt + 1;
        });
    })
}


// Joue le son
function jouerSon(idSon){
    miseEnPlaceSon(idSon);
    fetch('/controlleurApi.php/jouerSon/' + idSon, {
        method: 'POST',
        headers: {
            'Content-Type': 'audio/mpeg'
        },
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(function (data) {
        const audioBlobURL = URL.createObjectURL(data);
        const audio = new Audio();
        if (listeDattenteObj.sonEnCours instanceof Audio) {
            listeDattenteObj.sonEnCours.pause();
            listeDattenteObj.sonEnCours.currentTime = 0;
            listeDattenteObj.setSonEnCours(null, null);
        }
        audio.src = audioBlobURL;
        audio.load();
        listeDattenteObj.setSonEnCours(audio, idSon);
        const img = document.getElementById('imgPlayPause');
        img.src = "/assets/icons/play-lg.svg";
        audio.play();
    })
}

// met en place l'affichage du son
function miseEnPlaceSon(idSon){
    const cover = document.getElementById('cover');
    const titre = document.getElementById('nom-song');
    const artiste = document.getElementById('nom-artist');
    const time0 = document.getElementById('time0');
    const time1 = document.getElementById('time1');
    const slider = document.getElementById('slider');
    const heart = document.getElementById('main-heart');
    // slider.style.display = 'flex' ;

    fetch('/controlleurApi.php/infosSon/' + idSon, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(function (data) {
        cover.setAttribute('src', "data:image/png;base64," + data.cover);
        titre.innerHTML = data.titre;
        artiste.innerHTML = data.artiste;
        time0.innerHTML = "00:00";
        time1.innerHTML = data.duree;
        isLike = data.isLiked;
        if (isLike == true) {
            heart.classList.add('like');
        }
        else {
            heart.classList.remove('like');
        }
        heart.setAttribute('data-id-song', idSon);

        // changement de time0 toute les secondes
        setInterval(function () {
            if (listeDattenteObj.sonEnCours && !listeDattenteObj.sonEnCours.paused) {
                const time = listeDattenteObj.sonEnCours.currentTime;
                const minutes = Math.floor(time / 60);
                const secondes = Math.floor(time % 60);
                const timeString = minutes.toString().padStart(2, '0') + ':' + secondes.toString().padStart(2, '0');
                time0.innerHTML = timeString;

                const pourcentage = time / listeDattenteObj.sonEnCours.duration * 100;
                slider.value = pourcentage;

                slider.addEventListener('change', function () {
                    const pourcentage = slider.value;
                    const time = pourcentage / 100 * listeDattenteObj.sonEnCours.duration;
                    listeDattenteObj.sonEnCours.currentTime = time;
                });

            }
        }, 1000);
    })
}

function recupSon(idSon){
    miseEnPlaceSon(idSon);
    fetch('/controlleurApi.php/jouerSon/' + idSon, {
        method: 'POST',
        headers: {
            'Content-Type': 'audio/mpeg'
        },
    })
    .then(function (response) {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(function (data) {
        const audioBlobURL = URL.createObjectURL(data);
        const audio = new Audio();
        if (listeDattenteObj.sonEnCours instanceof Audio) {
            listeDattenteObj.sonEnCours.pause();
            listeDattenteObj.sonEnCours.currentTime = 0;
            listeDattenteObj.setSonEnCours(null, null);
        }
        audio.src = audioBlobURL;
        const img = document.getElementById('imgPlayPause');
        img.src = "/assets/icons/play.svg";
        audio.load();
        listeDattenteObj.setSonEnCours(audio, idSon);
    })
}
