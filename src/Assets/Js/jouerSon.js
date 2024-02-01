document.addEventListener('DOMContentLoaded', function () {
    var listeDattente = [];
    var indexSonEnCours = 0;
    var sonEnCours = null;

    // Controleur sur le son en cours de lecture pour lancer le suivant
    setInterval(function () {
        if (sonEnCours) {
            if (sonEnCours.ended) {
                if (listeDattente.length > 0) {
                    indexSonEnCours = (indexSonEnCours + 1) % listeDattente.length;
                    var idSon = listeDattente[indexSonEnCours];
                    jouerSon(idSon);
                }
            }
        }
    }, 1000);


    // Lancement d'un album
    var boutons = document.querySelectorAll('.playAlbum');
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            var idAlbum = this.getAttribute('data-id-album');
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
                indexSonEnCours = 0;
                lesAudios.forEach(function (audio) {
                    if (cpt === 0) {
                        jouerSon(audio.id);
                        listeDattente.push(audio.id);
                    }
                    else{
                        listeDattente.push(audio.id);
                    }
                    cpt = cpt + 1;
                });
            }
            )
        });
    });


    // Lancement des sons d'un artiste
    var boutons = document.querySelectorAll('.playArtist');
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            var idArtiste = this.getAttribute('data-id-artiste');
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
                indexSonEnCours = 0;
                lesAudios.forEach(function (audio) {
                    if (cpt === 0) {
                        jouerSon(audio.id);
                        listeDattente.push(audio.id);
                    }
                    else{
                        listeDattente.push(audio.id);
                    }
                    cpt = cpt + 1;
                });
            })
        });
    });


    // Lancement son top d'un artiste

    var boutons = document.querySelectorAll('.topSon');
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            var idSon = this.getAttribute('data-id-song');
            indexSonEnCours = 0;
            jouerSon(idSon);
        });
    });


    // Met le son courrant en pause
    var btnPause = document.getElementById('pause');
    btnPause.addEventListener('click', function () {
        if (sonEnCours) {
            if (sonEnCours.paused) {
                sonEnCours.play();
            } else {
                sonEnCours.pause();
            }
        }
    });

    var btnNextR = document.getElementById('nextR');
    btnNextR.addEventListener('click', function () {
        if (listeDattente.length > 0) {
            indexSonEnCours = (indexSonEnCours + 1) % listeDattente.length;
            var idSon = listeDattente[indexSonEnCours];
            jouerSon(idSon);

        }
    });

    var btnNextL = document.getElementById('nextL');
    btnNextL.addEventListener('click', function () {
        if (listeDattente.length > 0) {
            indexSonEnCours = (indexSonEnCours - 1);
            if (indexSonEnCours < 0) {
                indexSonEnCours = indexSonEnCours + listeDattente.length;
            }
            var idSon = listeDattente[indexSonEnCours];
            jouerSon(idSon);
        }
    });


    // Jou le son
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
            if (sonEnCours) {
                sonEnCours.pause();
                sonEnCours.currentTime = 0;
                sonEnCours = null;
            }
            audio.src = audioBlobURL;
            audio.load();
            sonEnCours = audio;
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
    slider.style.display = 'flex' ;

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

        // changement de time0 toute les secondes
        setInterval(function () {
            if (sonEnCours && !sonEnCours.paused) {
                const time = sonEnCours.currentTime;
                const minutes = Math.floor(time / 60);
                const secondes = Math.floor(time % 60);
                const timeString = minutes.toString().padStart(2, '0') + ':' + secondes.toString().padStart(2, '0');
                time0.innerHTML = timeString;

                const pourcentage = time / sonEnCours.duration * 100;
                slider.value = pourcentage;

                slider.addEventListener('change', function () {
                    const pourcentage = slider.value;
                    const time = pourcentage / 100 * sonEnCours.duration;
                    sonEnCours.currentTime = time;
                });

            }
        }, 1000);
    })
}
});



