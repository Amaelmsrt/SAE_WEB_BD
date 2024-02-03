document.addEventListener('DOMContentLoaded', function () {
    var listeDattenteObj = ListeDattente.getInstance() ;

    if (listeDattenteObj.numSonEnCours) {
        recupSon(listeDattenteObj.numSonEnCours);
    }

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
        });
    });


    // Lancement son top d'un artiste

    var boutons = document.querySelectorAll('.topSon');
    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            console.log('click');
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
        if (listeDattenteObj.sonEnCours) {
            if (listeDattenteObj.sonEnCours.paused) {
                listeDattenteObj.sonEnCours.play();
            } else {
                listeDattenteObj.sonEnCours.pause();
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
            // console.log(listeDattenteObj.sonEnCours);
            if (listeDattenteObj.sonEnCours instanceof Audio) {
                listeDattenteObj.sonEnCours.pause();
                listeDattenteObj.sonEnCours.currentTime = 0;
                listeDattenteObj.setSonEnCours(null, null);
            }
            audio.src = audioBlobURL;
            audio.load();
            listeDattenteObj.setSonEnCours(audio, idSon);
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
            // console.log(listeDattenteObj.sonEnCours);
            if (listeDattenteObj.sonEnCours instanceof Audio) {
                listeDattenteObj.sonEnCours.pause();
                listeDattenteObj.sonEnCours.currentTime = 0;
                listeDattenteObj.setSonEnCours(null, null);
            }
            audio.src = audioBlobURL;
            audio.load();
            listeDattenteObj.setSonEnCours(audio, idSon);
        })
    }
});
