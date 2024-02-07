var listeDattenteObj = ListeDattente.getInstance() ;

if (listeDattenteObj.numSonEnCours) {
    recupSon(listeDattenteObj.numSonEnCours);
    handleFileDattente();
}


function handleJouerSonFile(button){
    console.log(listeDattenteObj.liste);
    var idSon = button.getAttribute('data-id-song');
    var index = button.getAttribute('index');
    listeDattenteObj.setIndexSonEnCours(parseInt(index));
    jouerSon(idSon);
}


function handleFileDattente(){
    const attentContainer = document.getElementById('content-file');
    attentContainer.innerHTML = '';
    for (let i = listeDattenteObj.indexSonEnCours + 1; i < listeDattenteObj.liste.length + listeDattenteObj.indexSonEnCours; i++) {
        const idSon = listeDattenteObj.liste[i % listeDattenteObj.liste.length];
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
            const div = document.createElement('div');
            div.classList.add('artiste-row', 'glass');
            div.setAttribute('index', i);
            div.setAttribute('data-id-song', idSon);
            div.addEventListener('click', function () {
                handleJouerSonFile(this);
            });
            div.innerHTML = `
                <div class="infos">
                    <div class="container-cover">
                        <img src="data:image/png;base64,${data.cover}" alt="cover">
                    </div>
                    <div class="texts">
                        <h4>${data.titre}</h4>
                        <h5>${data.artiste}</h5>
                    </div>
                </div>
                <div class="actions">
                    <div class="edit-list">
                        <img class="btn-file-attente dow-file" src="./Assets/icons/down-arrow.svg" alt="down" index="${i}"/>
                        <img class="btn-file-attente up-file" src="./Assets/icons/up-arrow.svg" alt="up" index="${i}"/>
                    </div>
                    <img class="btn-file-attente close-file" src="./Assets/icons/close.svg" alt="close" index="${i}"/>
                </div>
            `;
            attentContainer.appendChild(div);
            const btnDown = div.querySelector('.actions .dow-file');
            btnDown.addEventListener('click', function (e) {
                e.stopPropagation();
                // On change dans la liste d'attente
                listeDattenteObj.moveSon(parseInt(this.getAttribute('index')), 1);

                // On change dans le DOM sans utiliser handleFileDattente
                const div = this.parentElement.parentElement.parentElement
                const nextDiv = div.nextElementSibling;
                if (nextDiv) {
                    attentContainer.insertBefore(nextDiv, div);
                    // On change les index des boutons du div cliqué
                    div.setAttribute('index', parseInt(this.getAttribute('index')) + 1);
                    const index = parseInt(this.getAttribute('index'));
                    this.setAttribute('index', index + 1);
                    const upBtn = div.querySelector('.actions .up-file');
                    upBtn.setAttribute('index', index + 1);
                    const close = div.querySelector('.actions .close-file');
                    close.setAttribute('index', index + 1);

                    // On change les index des boutons du div suivant
                    nextDiv.setAttribute('index', index);
                    const nextUpBtn = nextDiv.querySelector('.actions .up-file');
                    nextUpBtn.setAttribute('index', index);
                    const nextDownBtn = nextDiv.querySelector('.actions .dow-file');
                    nextDownBtn.setAttribute('index', index);
                    const nextClose = nextDiv.querySelector('.actions .close-file');
                    nextClose.setAttribute('index', index);
                }
            });

            const btnUp = div.querySelector('.actions .up-file');
            btnUp.addEventListener('click', function (e) {
                e.stopPropagation();
                listeDattenteObj.moveSon(parseInt(this.getAttribute('index')), -1);

                const div = this.parentElement.parentElement.parentElement
                const prevDiv = div.previousElementSibling;

                if (prevDiv) {
                    attentContainer.insertBefore(div, prevDiv);
                    // On change les index des boutons du div cliqué
                    div.setAttribute('index', parseInt(this.getAttribute('index')) - 1);
                    const index = parseInt(this.getAttribute('index'));
                    this.setAttribute('index', index - 1);
                    const downBtn = div.querySelector('.actions .dow-file');
                    downBtn.setAttribute('index', index - 1);
                    const close = div.querySelector('.actions .close-file');
                    close.setAttribute('index', index - 1);

                    // On change les index des boutons du div précédent
                    prevDiv.setAttribute('index', index);
                    const prevUpBtn = prevDiv.querySelector('.actions .up-file');
                    prevUpBtn.setAttribute('index', index);
                    const prevDownBtn = prevDiv.querySelector('.actions .dow-file');
                    prevDownBtn.setAttribute('index', index);
                    const prevClose = prevDiv.querySelector('.actions .close-file');
                    prevClose.setAttribute('index', index);
                }
            });

            const btnClose = div.querySelector('.actions .close-file');
            btnClose.addEventListener('click', function (e) {
                e.stopPropagation();
                listeDattenteObj.removeSon(parseInt(this.getAttribute('index')));
                const index = parseInt(this.getAttribute('index'));
                div.remove();
                console.log(listeDattenteObj.liste);
                // on change les index des boutons des div qui étaient après celui supprimé car ils ont été décalés
                const divs = attentContainer.querySelectorAll('.artiste-row');
                for (let i = 0; i < divs.length; i++) {
                    if (parseInt(divs[i].querySelector('.actions .dow-file').getAttribute('index')) > index) {
                        divs[i].setAttribute('index', parseInt(divs[i].getAttribute('index')) - 1);
                        const downBtn = divs[i].querySelector('.actions .dow-file');
                        downBtn.setAttribute('index', parseInt(downBtn.getAttribute('index')) - 1);
                        const upBtn = divs[i].querySelector('.actions .up-file');
                        upBtn.setAttribute('index', parseInt(upBtn.getAttribute('index')) - 1);
                        const close = divs[i].querySelector('.actions .close-file');
                        close.setAttribute('index', parseInt(close.getAttribute('index')) - 1);
                    }
                }
            });
        })
    }
}


// Slider pour le volume
const sliderSons = document.querySelectorAll('.bar.vertical');
sliderSons.forEach(function (slider) {
    slider.addEventListener('change', function () {
        const pourcentage = slider.value;
        listeDattenteObj.sonEnCours.volume = pourcentage / 100;
    });
});



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
        if (listeDattenteObj.sonEnCours.paused) {
            const img = document.getElementById('imgPlayPause');
            img.src = "/assets/icons/play.svg";
        }
        else {
            const img = document.getElementById('imgPlayPause');
            img.src = "/assets/icons/play-lg.svg";
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
        lesAudios.forEach(function (audioId) {
            if (cpt === 0) {
                jouerSon(audioId);
                listeDattenteObj.addSon(audioId);
            }
            else{
                listeDattenteObj.addSon(audioId);
            }
            cpt = cpt + 1;
        });
        // handleFileDattente();
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
        // handleFileDattente();
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
        // handleFileDattente();
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
        const sliders = document.querySelectorAll('.bar');
        sliders.forEach(function (slider) {
            const pourcentage = slider.value;
            audio.volume = pourcentage / 100;
        });
        listeDattenteObj.setSonEnCours(audio, idSon);
        const img = document.getElementById('imgPlayPause');
        img.src = "/assets/icons/play-lg.svg";
        audio.play();
        handleFileDattente();
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
