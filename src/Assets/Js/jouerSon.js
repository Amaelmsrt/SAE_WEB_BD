gsap.registerPlugin(CustomEase);

CustomEase.create("slow", "M0,0 C0.2,0 0.3,1 1,1");

const listeDattenteObj = ListeDattente.getInstance() ;

if (listeDattenteObj.numSonEnCours) {
    recupSon(listeDattenteObj.numSonEnCours);
    handleFileDattente(1);
}



const btnAgrandirFile = document.querySelectorAll('.btnOuvrirFileAttente');
btnAgrandirFile.forEach(btn => {
    btn.addEventListener('click', () => {
        handleFileDattente(2);

    })
})


function handleJouerSonFile(button){
    const idSon = button.getAttribute('data-id-song');
    const index = button.getAttribute('index');
    listeDattenteObj.setIndexSonEnCours(parseInt(index));
    jouerSon(idSon);
}


function handleFileDattente(num){
    const attentContainer = num == 1 ? document.getElementById('content-file') : document.getElementById('fileAgr');
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
                if (num == 2){
                    handleFileDattente(1);
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
                if (num == 2){
                    handleFileDattente(1);
                }
            });

            const btnClose = div.querySelector('.actions .close-file');
            btnClose.addEventListener('click', function (e) {
                e.stopPropagation();
                listeDattenteObj.removeSon(parseInt(this.getAttribute('index')));
                const index = parseInt(this.getAttribute('index'));
                div.remove();
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
                if (num == 2){
                    handleFileDattente(1);
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
    // on regarde si l'id du btn est différent de main-heart
    const isDifferent = btn.id != "main-heart";
    if (isDifferent){
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            handleLike(this);
        });
        // envie d'ajouter un listener sur le press et la fin du press pour changer l'icone
        btn.addEventListener('mousedown', () => {
            gsap.to(btn, {scale: 0.9, duration: 0.1, ease: "power1.inOut"})
        })
        btn.addEventListener('mouseup', () => {
            gsap.to(btn, {scale: 1, duration: 0.1, ease: "power1.inOut"})
        })
    }
});

function handleLike(button){
    const sonId = button.getAttribute('data-id-song');
    const idUtilisateur = button.getAttribute('data-id');
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
            const counLike = document.getElementById('countLike');
            // Format : "5 titres"
            const count = counLike.innerHTML.split(' ')[0];
            const newCount = parseInt(count) + 1;
            if (newCount == 1) {
                counLike.innerHTML = newCount + ' titre';
            }
            else {
                counLike.innerHTML = newCount + ' titres';
            }
            button.classList.add('like');
            // Ajoute le son à la liste des favoris
            const contentFav = document.getElementById('contentFavoris');
            const div1 = document.createElement('div');
            div1.classList.add('artiste-wrapper');
            const div = document.createElement('div');
            div.classList.add('artiste-row', 'glass', 'with-dots', 'topSon');
            div.setAttribute('data-id-song', sonId);
            div1.appendChild(div);
            fetch ('/controlleurApi.php/infosSon/' + sonId, {
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
                div.innerHTML = `
                    <div class="infos">
                        <div class="container-cover">
                            <img src="data:image/jpeg;base64,${data.cover}" alt="cover">
                        </div>
                        <div class="texts">
                            <h4>${data.titre}</h4>
                            <h5>${data.artiste}</h5>
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
                                <button class="consulteArtiste-fav" id-artiste="${data.idArtist}">
                                    <svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.2405 24.7722C19.8065 24.7722 21.1404 23.4819 20.7854 21.9567C19.9025 18.1628 16.9499 16.2658 11.1519 16.2658C5.35387 16.2658 2.40129 18.1628 1.51836 21.9567C1.16341 23.4819 2.49732 24.7722 4.06329 24.7722H18.2405Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.1519 12.0127C13.9873 12.0127 15.4051 10.5949 15.4051 7.05063C15.4051 3.50633 13.9873 2.08861 11.1519 2.08861C8.31645 2.08861 6.89873 3.50633 6.89873 7.05063C6.89873 10.5949 8.31645 12.0127 11.1519 12.0127Z" stroke="currentColor" stroke-width="2.83544" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                                        
                                    Consulter l'artiste
                                </button>
                            </li>
                            <li>
                                <button class="consuleAlbum-fav" id-album="${data.album}">
                                    <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 13.5C6 14.8807 4.88071 16 3.5 16C2.11929 16 1 14.8807 1 13.5C1 12.1193 2.11929 11 3.5 11C4.88071 11 6 12.1193 6 13.5ZM6 13.5V2.91321C6 2.39601 6.39439 1.96415 6.90946 1.91732L15.9095 1.09914C16.4951 1.0459 17 1.507 17 2.09503V12.5M17 12.5C17 13.8807 15.8807 15 14.5 15C13.1193 15 12 13.8807 12 12.5C12 11.1193 13.1193 10 14.5 10C15.8807 10 17 11.1193 17 12.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>    
                                    Consulter l'album
                                </button>
                            </li>
                            <li>
                                <button class="fileAttente-fav" data-id="${data.id}">
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
                            
                                <!-- un sous menu avec pleins de boutons sans icones "playlist 1", "playlist 2"... -->
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
                                <button data-id="${data.idUser}" class="likeSong-fav" data-id-song="${data.id}">
                                    <svg width="37" height="33" viewBox="0 0 37 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.4999 31.1667C18.4999 31.1667 6.20162 23.1767 2.83328 15.5C-1.67089 5.23832 12.6249 -4.08335 18.4999 6.92249C24.3749 -4.08335 38.6708 5.23832 34.1666 15.5C30.7983 23.1571 18.4999 31.1667 18.4999 31.1667Z" stroke="#FEFCE1" stroke-width="2.84848" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                                        
                                    Liker ce titre
                                </button>
                            </li>
                        </ul>
                    </div>
                    `;
                // Ajout event menu point
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


                div1.addEventListener('click', function () {
                    jouerSon(sonId);
                });
                
                contentFav.appendChild(div1);
            });
        } else {
            const counLike = document.getElementById('countLike');
            // Format : "5 titres"
            const count = counLike.innerHTML.split(' ')[0];
            const newCount = parseInt(count) - 1;
            if (newCount == 1 || newCount == 0) {
                counLike.innerHTML = newCount + ' titre';
            }
            else {
                counLike.innerHTML = newCount + ' titres';
            }
            const contentFav = document.getElementById('contentFavoris');
            for (let i = 0; i < contentFav.children.length; i++) {
                if (contentFav.children[i].children[0].getAttribute('data-id-song') === sonId) {
                    contentFav.removeChild(contentFav.children[i]);
                    break;
                }
            }
            button.classList.remove('like');
        }
        const btnLikeSon = document.querySelectorAll('.likeSong');
        btnLikeSon.forEach(function (btn) {
            if (btn.getAttribute('data-id-song') === sonId) {
                const heartSvg = btn.querySelector('svg');
                const rects = btn.querySelectorAll('.rect');
                if (data.like == true) {
                    btn.classList.add('like');
                    
                    gsap.to(btn, {scale: 0.9, duration: 0.1, ease: "power1.inOut"})

                    setTimeout(() => {
                        gsap.to(btn, {scale: 1, duration: 0.15, ease: "power1.inOut"})
                    }, 150);

                    // on anime le changement de la couleur de fond du svg vers le
                    gsap.to(heartSvg, {color: "#ED1C24", fill:"#ED1C24", duration: 0.04, ease: "power1.inOut"})
                    rects.forEach((rect, index) => {
                        let tl = gsap.timeline();
                        tl.fromTo(rect, {
                            opacity: 0,
                            left: "50%",
                            top: "50%",
                            width: "0px",
                        }, {
                            opacity: 1,
                            duration: 0.04,
                            ease: "slow",
                            left: index ===0 ? "0%" : index === 1 ? "10%" : index == 2? "50%" : index == 3 ? "90%" : index == 4 ? "50%" : index == 5 ? "90%" : index == 6 ? "10%": "100%",
                            top : index ===0 ? "50%" : index === 1 ? "10%" : index == 2 ? "0%" : index == 3 ? "10%" : index == 4 ? "100%" : index == 5 ? "90%" : index == 6 ? "90%" : "50%",
                            width:"12px",
                        })
                        .to(rect, {
                            width: "8px",
                            duration: 0.2,
                            left: index ===0 ? "-25%" : index === 1 ? "-15%" : index == 2? "50%" : index == 3 ? "115%" : index == 4 ? "50%" : index == 5 ? "115%" : index == 6 ? "-15%": "125%",
                            top : index ===0 ? "50%" : index === 1 ? "-15%" : index == 2 ? "-25%" : index == 3 ? "-15%" : index == 4 ? "125%" : index == 5 ? "115%" : index == 6 ? "115%" : "50%",
                            ease: "slow"
                        })
                        .to(rect, {
                            opacity:0,
                            width: "0px",
                            duration: 0.35,
                            ease: "slow"
                        })
                    })

                } else {
                    btn.classList.remove('like');
                    gsap.to(heartSvg, {color: "#FEFCE1", fill:"transparent", duration: 0.15, ease: "power1.inOut"})
                }
            }
        });
    })
    .catch(function (error) {
        console.error('Fetch error:', error);
    });
}

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
                const idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
                jouerSon(idSon);
            }
        }
        if (listeDattenteObj.sonEnCours.paused) {
            const img = document.getElementById('imgPlayPause');
            img.src = "./Assets/icons/play-content.svg";
        }
        else {
            const img = document.getElementById('imgPlayPause');
            img.src = "./Assets/icons/play-lg.svg";
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
        handleJouerSon(this);
    });
});


// Met le son courrant en pause
const btnPause = document.getElementById('playPause');
btnPause.addEventListener('click', function () {
    const img = document.getElementById('imgPlayPause');
    if (listeDattenteObj.sonEnCours) {
        if (listeDattenteObj.sonEnCours.paused) {
            listeDattenteObj.sonEnCours.play();
            img.src = "./Assets/icons/play-lg.svg";
        } else {
            listeDattenteObj.sonEnCours.pause();
            img.src = "./Assets/icons/play-content.svg";
        }
    }
});

btnPause.addEventListener('mousedown', () => {
    gsap.to(btnPause, {scale: 0.95, duration: 0.1, ease: "power1.inOut"})
})

btnPause.addEventListener('mouseup', () => {
    gsap.to(btnPause, {scale: 1, duration: 0.1, ease: "power1.inOut"})
})

const btnNextR = document.getElementById('next');
btnNextR.addEventListener('click', function () {
    if (listeDattenteObj.liste.length > 0) {
        listeDattenteObj.setIndexSonEnCours((listeDattenteObj.indexSonEnCours + 1) % listeDattenteObj.liste.length);
        const idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
        jouerSon(idSon, true, false);
    }
});

const btnNextL = document.getElementById('back');
btnNextL.addEventListener('click', function () {
    if (listeDattenteObj.liste.length > 0) {
        listeDattenteObj.setIndexSonEnCours((listeDattenteObj.indexSonEnCours - 1));
        if (listeDattenteObj.indexSonEnCours < 0) {
            listeDattenteObj.setIndexSonEnCours(listeDattenteObj.indexSonEnCours + listeDattenteObj.liste.length);
        }
        const idSon = listeDattenteObj.liste[listeDattenteObj.indexSonEnCours];
        jouerSon(idSon, false, true);
    }
});

const btnPlayFav = document.getElementById('playFav');
btnPlayFav.addEventListener('click', function () {
    handleJouerFavorite(this);
});

function handleJouerFavorite(button){
    const idUtilisateur = button.getAttribute('data-id');
    fetch('/controlleurApi.php/jouerFavorite/' + idUtilisateur, {
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

// Jouer un album
function handleJouerAlbum(button){
    const idAlbum = button.getAttribute('data-id-album');
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
    const idArtiste = button.getAttribute('data-id-artiste');
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

function handleJouerSon(button){
    const idSon = button.getAttribute('data-id-song');
    if (idSon != "" && idSon != null){
        listeDattenteObj.setIndexSonEnCours(0);
        listeDattenteObj.setListe([]);
        jouerSon(idSon);
        listeDattenteObj.addSon(idSon);
    }
}


// Joue le son
function jouerSon(idSon, isNext = false, isPrev = false){
    miseEnPlaceSon(idSon, isNext, isPrev);
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
        img.src = "./Assets/icons/play-lg.svg";
        audio.play();
        handleFileDattente(1);
    })
}

// met en place l'affichage du son
function miseEnPlaceSon(idSon, isNext = false, isPrev = false){

    const curMedia = document.getElementById('curMedia');

    // on duplique le curMedia dans son parent
    const newMedia = curMedia.cloneNode(true);
    curMedia.parentElement.appendChild(newMedia);

    const cover = newMedia.querySelector('#cover');
    const titre = newMedia.querySelector('#nom-song');
    const artiste = newMedia.querySelector('#nom-artist');
    const time0 = document.querySelectorAll('.time0');
    const time1 = document.querySelectorAll('.time1');
    const slider = document.querySelector('#slider');
    const heart = newMedia.querySelector('#main-heart');

    // on remet les event listener sur le coeur

    heart.addEventListener('click', function (e) {
        e.stopPropagation();
        handleLike(heart);
    });

    heart.addEventListener('mousedown', () => {
        gsap.to(heart, {scale: 0.9, duration: 0.1, ease: "power1.inOut"})
    })

    heart.addEventListener('mouseup', () => {
        gsap.to(heart, {scale: 1, duration: 0.1, ease: "power1.inOut"})
    })

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
        time0.forEach((t0) => t0.innerHTML= "00:00") 
        time1.forEach((t1) => t1.innerHTML= data.duree);
        isLike = data.isLiked;
        if (isLike == true) {
            heart.classList.add('like');
            gsap.to(heart.querySelector('svg'), {color: "#ED1C24", fill:"#ED1C24", duration: 0.15, ease: "power1.inOut"})
        }
        else {
            heart.classList.remove('like');
            gsap.to(heart.querySelector('svg'), {color: "#FEFCE1", fill:"transparent", duration: 0.15, ease: "power1.inOut"})
        }

        heart.setAttribute('data-id-song', idSon);

        gsap.to(curMedia, {
            x: isNext ? "-100%" : isPrev ? "100%" : "0%",
            opacity: 0,
            zIndex: 0,
            scale: 0.8,
            duration: 0.45,
            ease: "slow",
            onComplete: () => {
                curMedia.remove();
        }})

        gsap.fromTo(newMedia, {
            x: isNext ? "100%" : isPrev ? "-100%" : "0%",
            scale: 0.8,
            opacity: 0,
            zIndex: 1,
        }, {
            x: "0%",
            scale: 1,
            opacity: 1,
            duration: 0.45,
            delay: isNext || isPrev ? 0 : 0.15,
            ease: "slow",
        })

        // changement de time0 toute les secondes
        setInterval(function () {
            if (listeDattenteObj.sonEnCours && !listeDattenteObj.sonEnCours.paused) {
                const time = listeDattenteObj.sonEnCours.currentTime;
                const minutes = Math.floor(time / 60);
                const secondes = Math.floor(time % 60);
                const timeString = minutes.toString().padStart(2, '0') + ':' + secondes.toString().padStart(2, '0');
                time0.forEach((t0) => t0.innerHTML = timeString);

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
        img.src = "./Assets/icons/play-content.svg";
        audio.load();
        listeDattenteObj.setSonEnCours(audio, idSon);
    })
}

function handleAjouterSonFile(button){
    const idSon = button.getAttribute('data-id');
    listeDattenteObj.addSon(idSon);
    handleFileDattente(1);
}

function handleJouerPlaylist(idPlaylist){
    fetch('/controlleurApi.php/jouerPlaylist/' + idPlaylist, {
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